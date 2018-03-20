<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Illuminate\Http\Request;
use JWTAuth;

class UserController extends Controller
{
	/**
	 * @param Request $request
	 * @return type
	 */
    public function show($code)
	{
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($code)->roleMobileApp()->first();
        
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
            'message' => 'success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
	}
    
    /**
     * update profile
     * 
     * @param type $code
     * @param Request $request
     * @return json
     */
    public function update($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user,email,'.$user->id,
            'gender' => 'required|in:'.User::GENDER_MALE.','.User::GENDER_FEMALE,
            'phone' => 'required',
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

        $user->fill($request->only([
            'name',
            'email',
            'gender',
            'phone',
        ]));
        $user->save();
        $user->userRelation->fill($request->only([
            'wedding_day',
            'venue'
        ]));
        $user->userRelation->save();
        
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
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function deletePhoto($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relation->deletePhoto();
            $relation->photo = null;
            $relation->save();
            
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation;
            $relation->deletePhoto();
            $relation->photo = null;
            $relation->save();
            
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Delete Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function updatePhoto($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        $validator = \Validator::make($request->all(), [
            'photo_base64' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}

        $imageBase64 = $request->photo_base64;
        if (!ImageHelper::isImageBase64($imageBase64)) {
            return response()->json([
                'status' => 400,
                'message' => 'Some Parameters is invalid',
                'validators' => [
                    'photo_base64' => 'format is invalid',
                ],
            ], 400);
        }

        $data = ImageHelper::getImageBase64Information($imageBase64);
        $img = \Eventviva\ImageResize::createFromString(base64_decode($data['data']));
        $img->resizeToWidth(780);
        $img->crop(780, 560);
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relation->deletePhoto();
            $imageFilename = $relation->generateFilename($data['extension']);
            $img->save($relation->getPath() . $imageFilename);
            $relation->photo = $imageFilename;
            $relation->save();
        } else {
            $relation = $user->femaleUserRelation;
            $relation->deletePhoto();
            $imageFilename = $relation->generateFilename($data['extension']);
            $img->save($relation->getPath() . $imageFilename);
            $relation->photo = $imageFilename;
            $relation->save();
        }

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
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    public function costs(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $costs = $user->userRelation->getListCosts();
        $grandCost = null;
        foreach ($costs as $cost) :
            $grandCost += $cost->value;
        endforeach;
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'grand_cost' => $grandCost,
            'data' => $costs,
        ], 200);
    }
    
    
    public function resendRegisterRelation($userId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relationPartner = $relation->female_user;
        } else {
            $relation = $user->femaleUserRelation;
            $relationPartner = $relation->male_user;
        }
        
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:user,email,'.$relationPartner->id,
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $relationPartner->email = $request->email;
        $relationPartner->save();
        $relationPartner->sendNeedRegisterNotification();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [],
        ], 200);
       
    }
}
