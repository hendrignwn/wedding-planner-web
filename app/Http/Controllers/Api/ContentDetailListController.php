<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\ContentDetail;
use App\ContentDetailList;
use App\Helpers\FormatConverter;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\User;
use Eventviva\ImageResize;
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
        $contentDetailList = ContentDetailList::where('content_detail_id', $contentDetailId)
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
        $user = JWTAuth::parseToken()->authenticate();
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
        $img = ImageResize::createFromString(base64_decode($data['data']));
        $img->resizeToWidth(780);
        $img->crop(780, 560);
        
        
        
        $contentDetailList = new ContentDetailList();
        $contentDetailList->content_detail_id = $contentDetailId;
        $contentDetailList->name = $user->name + ' ' + (ContentDetailList::getLastOrderByContentDetailId($contentDetailId) + 1);
        
        $imageFilename = $contentDetailList->generateFilename($data['extension']);
        $img->save($contentDetailList->getPath() . $imageFilename);
        $contentDetailList->value = $imageFilename;
        $contentDetailList->status = ContentDetailList::STATUS_ACTIVE;
        $contentDetailList->order = ContentDetailList::getLastOrderByContentDetailId($contentDetailId) + 1;
        $contentDetailList->save();

        $contentDetail = ContentDetail::whereId($contentDetailId)->actived()->first();
        $contentDetailList = ContentDetailList::where('content_detail_id', $contentDetailId)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 201,
            'message' => 'Success',
            'data' => [
                'content_detail' => $contentDetail,
                'content_detail_list' => $contentDetailList,
            ]
        ], 201);
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

        $contentDetailList = ContentDetailList::whereId($id)->first();
        if (!$contentDetailList) {
            return response()->json([
                'status' => 404,
                'message' => 'Data ini tidak dapat di hapus',
                'data' => [],
            ], 404);
        }
        
        $contentDetailList->deletePhoto();
        $contentDetailList->delete();
        
        $contentDetail = ContentDetail::whereId($contentDetailList->content_detail_id)->actived()->first();
        $contentDetailList = ContentDetailList::where('content_detail_id', $contentDetailList->content_detail_id)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Delete Success',
            'data' => [
                'content_detail' => $contentDetail,
                'content_detail_list' => $contentDetailList,
            ]
        ], 200);
                
    }
}
