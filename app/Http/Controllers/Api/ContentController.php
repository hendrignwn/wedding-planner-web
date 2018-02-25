<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\ContentDetail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContentController extends Controller
{
    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function index($conteptId, Request $request)
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
        
        $userRelationId = $user->userRelation ? $user->userRelation->id : null;
        if (!$userRelationId) {
            return response()->json([
				'status' => 500,
				'message' => 'Something error. Please try again'
			], 500);
        }
        
        $contents = Content::where('user_relation_id', $userRelationId)
                ->where('concept_id', $conteptId)
                ->actived()
                ->ordered()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $contents
        ], 200);
    }
}
