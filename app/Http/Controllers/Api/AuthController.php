<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRelation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
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
                case User::STATUS_INACTIVE :
                    return response()->json([
                        'status' => 401,
                        'message' => 'Your Account has been blocked',
                    ], 401);
                case User::STATUS_NEED_REGISTER :
                    return response()->json([
                        'status' => 401,
                        'message' => 'Your Account must be registered, please check your email',
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user,email',
            'gender' => 'required|in:'.User::GENDER_MALE.','.User::GENDER_FEMALE,
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'registered_device_number' => 'required',
            'firebase_token' => 'required',
            'relation_email' => 'required|email|max:255|unique:user,email',
            'wedding_day' => 'required',
            'venue' => 'required',
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
            'name',
            'email',
            'gender',
            'phone',
            'registered_device_number',
            'firebase_token',
        ]));
        $user->password = bcrypt($request->password);
        $user->registered_at = Carbon::now()->toDateTimeString();
        $user->last_login_at = Carbon::now()->toDateTimeString();
        $user->status = User::STATUS_ACTIVE;
        $user->role = User::ROLE_USER;
        $user->save();
        
        $token = JWTAuth::fromUser($user);
        $user->last_login_at = Carbon::now()->toDateTimeString();
        $user->firebase_token = $request['firebase_token'];
        $user->device_number = $request['device_number'];
        $user->token = $token;
        $user->save();
        
        if ($user->gender == User::GENDER_MALE) :
            $userFemale = new User();
            $userFemale->email = $request->relation_email;
            $userFemale->gender = User::GENDER_FEMALE;
            $userFemale->status = User::STATUS_NEED_REGISTER;
            $userFemale->role = User::ROLE_USER;
            $userFemale->registered_token = str_random(25);
            $userFemale->save();
            
            $userRelation = new UserRelation();
            $userRelation->male_user_id = $user->id;
            $userRelation->female_user_id = $userFemale->id;
            $userRelation->wedding_day = $request->wedding_day;
            $userRelation->venue = $request->venue;
            $userRelation->save();
            
            $userFemale->sendNeedRegisterNotification();
        else:
            $userMale = new User();
            $userMale->email = $request->relation_email;
            $userMale->gender = User::GENDER_MALE;
            $userMale->status = User::STATUS_NEED_REGISTER;
            $userMale->role = User::ROLE_USER;
            $userMale->registered_token = str_random(25);
            $userMale->save();
            
            $userRelation = new UserRelation();
            $userRelation->female_user_id = $user->id;
            $userRelation->male_user_id = $userMale->id;
            $userRelation->wedding_day = $request->wedding_day;
            $userRelation->venue = $request->venue;
            $userRelation->save();
            
            $userMale->sendNeedRegisterNotification();
        endif;
        
        $user->sendRegisterNotification();
        
        // insert first data
        $user->insertFirstContentData();
        
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
            'status' => 201,
            'message' => 'Register success, please check your email',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 201);
	}
    
	/**
	 * @param Request $request
	 */
	public function registerInvitation(Request $request)
	{
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'registered_device_number' => 'required',
            'firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $user = User::where('registered_token', $request->confirm)
                ->where('status', User::STATUS_NEED_REGISTER)
                ->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User is not found'
            ], 404);
        }
        
        $user->fill($request->only([
            'name',
            'email',
            'phone',
            'registered_device_number',
            'firebase_token',
        ]));
        $user->password = bcrypt($request->password);
        $user->registered_at = Carbon::now()->toDateTimeString();
        $user->last_login_at = Carbon::now()->toDateTimeString();
        $user->status = User::STATUS_ACTIVE;
        $user->role = User::ROLE_USER;
        $user->registered_token = null;
        $user->save();
        $user->sendRegisterNotification();
        
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
            'status' => 201,
            'message' => 'Register success, please check your email',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 201);
	}
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function forgotPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:user,email',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $user = User::where('email', $request->email)
                ->where('status', User::STATUS_ACTIVE)
                ->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User is not found'
            ], 404);
        }
        
        $user->forgot_token = str_random(25);
        $user->save();
        $user->sendForgotPasswordNotification();

        return response()->json([
            'status' => 200,
            'message' => 'Forgot password success, please check your email',
        ], 200);
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function resetPassword(Request $request)
    {
        $user = User::where('forgot_token', $request->confirm)
                ->where('status', User::STATUS_ACTIVE)
                ->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User is not found'
            ], 404);
        }
        
        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $user->password = bcrypt($request->password);
        $user->forgot_token = null;
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
            'message' => 'Reset Password Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
}
