<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\ContentDetail;
use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContentDetailController extends Controller
{
    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function index($contentId, Request $request)
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
                
        $content = Content::whereId($contentId)->actived()->first();
        $contentDetails = ContentDetail::where('content_id', $contentId)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'content' => $content,
                'content_details' => $contentDetails,
            ]
        ], 200);
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
    
    public function store($contentId, Request $request)
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
        
        $content = Content::whereId($contentId)->first();
        if (!$content) {
            return response()->json([
                'status' => 404,
                'message' => 'Gagal, silahkan input kembali',
            ], 404);
        }
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $contentDetail = new ContentDetail();
        $contentDetail->content_id = $contentId;
        $contentDetail->name = $request->name;
        $contentDetail->value = $request->value;
        $contentDetail->status = ContentDetail::STATUS_ACTIVE;
        $contentDetail->is_not_deleted = ContentDetail::IS_NOT_DELETED_FALSE;
        $contentDetail->order = 0;
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
    
    public function delete($id, Request $request)
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
        
        $contentDetail = ContentDetail::whereId($id)
                ->where('is_not_deleted', ContentDetail::IS_NOT_DELETED_FALSE)
                ->first();
        if (!$contentDetail) {
            return response()->json([
                'status' => 404,
                'message' => 'Data ini tidak dapat di hapus',
            ], 404);
        }
        $contentId = $contentDetail->content_id;
        $contentDetail->delete();
        
        $content = Content::whereId($contentId)->actived()->first();
        $contentDetails = ContentDetail::where('content_id', $contentId)
                ->actived()
                ->ordered()
                ->get();
        
        
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus',
            'data' => [
                'content' => $content,
                'content_details' => $contentDetails,
            ]
        ], 200);
    }
}
