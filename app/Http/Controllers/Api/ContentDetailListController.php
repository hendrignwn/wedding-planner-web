<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\ContentDetail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContentDetailListController extends Controller
{
    /**
     * @param type $id = content_detail_id
     * @param Request $request
     * @return type
     */
    public function index($contentDetailId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($user->id)->roleMobileApp()->first();
        if (!$user) {
            return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
                
        $contentDetail = ContentDetail::whereId($contentDetailId)->actived()->first();
        $contentDetailList = \App\ContentDetailList::where('content_detail_id', $contentDetailId)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'content_detail' => $contentDetail,
                'content_detail_list' => $contentDetailList,
            ]
        ], 200);
    }
    
    public function store($contentDetailId, Request $request)
    {
        
    }
    
    /**
     * 
     * @param type $id
     * @param Request $request
     * @return type
     */
    public function update($id, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($user->id)->roleMobileApp()->first();
        if (!$user) {
            return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $validator = \Validator::make($request->all(), [
            'value' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $contentDetail = ContentDetail::whereId($id)->actived()->first();
        if (!$contentDetail) {
            return response()->json([
				'status' => 404,
				'message' => 'data is not found'
			], 404);
        }
        
        $contentDetail->value = $request->value;
        $contentDetail->save();
        
        $content = Content::whereId($contentDetail->content_id)->actived()->first();
        $contentDetails = ContentDetail::where('content_id', $content->id)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Data is successfully saved',
            'data' => [
                'content' => $content,
                'content_details' => $contentDetails,
            ]
        ], 200);
    }
    
    public function delete($id)
    {
        
    }
}
