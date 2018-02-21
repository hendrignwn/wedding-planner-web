<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use function bcrypt;
use function response;

class AuthController extends Controller
{
	/**
	 * @param Request $request
	 * @return type
	 */
    public function login(Request $request)
	{
        $credentials = $request->only('email', 'password');
		$validator = \Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required',
			'firebase_token' => 'required',
			'device_number' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
					'status' => 401,
					'message' => 'Invalid Credentials'
				], 401);
            }
            
            $user = User::whereEmail($request->email)->roleMobileApp()->first();
            if (!$user) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials'
                ], 401);
            }
            
            switch ($user->status) {
                case User::STATUS_INACTIVE_OR_BLOCK :
                    return response()->json([
                        'status' => 401,
                        'message' => 'Your Account has been blocked',
                    ], 401);
                case User::STATUS_NEED_CONFIRMATION :
                    return response()->json([
                        'status' => 401,
                        'message' => 'Your Account must be confirmation, please check your email',
                    ], 401);
            }
            
            $token = JWTAuth::fromUser($user);
            $user->last_login_at = Carbon::now()->toDateTimeString();
            $user->firebase_token = $request['firebase_token'];
            $user->device_number = $request['device_number'];
            $user->token = $token;
            $user->save();
            
            if ($user->gender == User::GENDER_MALE) {
                $relation = $user->maleUserRelation->toArray();
                $relation['partner'] = $relation['female_user'];
                unset($user->maleUserRelation);
                unset($relation['male_user']);
                unset($relation['female_user']);
            } else {
                $relation = $user->femaleUserRelation->toArray();
                $relation['partner'] = $relation['male_user'];
                unset($user->femaleUserRelation);
                unset($relation['male_user']);
                unset($relation['female_user']);
            }
            
            
            

            return response()->json([
                'status' => 200,
                'message' => 'Login Success',
                'data' => array_merge($user->toArray(), [
                    'relation' => $relation
                ]),
            ], 200);
            
        } catch (Exception $ex) {
            return response()->json([
				'status' => 400,
				'message' => $ex->getMessage()
			], 400);
        }
    }
    
	/**
	 * @param Request $request
	 * @return type
	 */
    public function logout(Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		
		JWTAuth::parseToken()->invalidate();

        return response()->json([
			'status' => 200,
			'message' => 'Logout success',
		], 200);
    }

	/**
	 * @param Request $request
	 */
	public function register(Request $request)
	{
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user,email',
            'role' => 'required|in:'.User::ROLE_USER.','.User::ROLE_COUNSELOR,
            //'gender' => 'required|in:'.User::GENDER_MALE.','.User::GENDER_FEMALE,
            'language' => 'required|in:'. \App\UserSetting::LANGUAGE_ENGLISH.','.\App\UserSetting::LANGUAGE_INDONESIA,
            //'dob' => 'required',
            //'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            //'pin_code' => 'integer',
            'registered_device_number' => 'required',
            'firebase_token' => 'required',
            'temp_user_code' => 'required|exists:user_questionnaire,temp_user_code',
        ]);


        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $user = new User();
        $user->fill($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'email',
            'gender',
            'phone',
            'dob',
            'role',
            'registered_device_number',
            'firebase_token',
            'pin_code',
        ]));
        $user->code = User::generateCode();
        $user->registered_at = Carbon::now()->toDateTimeString();
        $user->last_login_at = Carbon::now()->toDateTimeString();
        $user->status = User::STATUS_NEED_CONFIRMATION;
        if ($user->role == User::ROLE_USER) :
            $user->activation_code = $user->generateActivationCode();
        endif;
        $user->device_number = $request->registered_device_number;
        $user->firebase_token = $request->firebase_token;
        $user->token = JWTAuth::fromUser($user);
        $user->password = bcrypt($request->password);

        $user->save();
        
        $user->firstInsertUserSetting([
            'language' => $request->language
        ]);
        
        $userQuestionnaire = \App\UserQuestionnaire::whereTempUserCode($request->temp_user_code)->update([
            'temp_user_code' => null,
            'user_id' => $user->id
        ]);
        
        $user->sendEmailRegisterNotification();

        return response()->json([
            'status' => 201,
            'message' => 'Register success, please check your email',
            'data' => $user,
        ], 201);
	}
}
