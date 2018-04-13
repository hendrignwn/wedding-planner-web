<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CostController extends Controller
{
    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $models = ContentDetail::whereHas('content', function($query) {
                $query->where('content.user_relation_id', '=', $this->id);
            })
            ->with(['content'])
            ->join('content', 'content.id', '=', 'content_detail.content_id')
            ->select([DB::raw('content_detail.*, SUM(content_detail.value) as value')])
            ->where('content_detail.is_cost', '=', 1)
            ->groupBy('content.grouping')
            ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'concept_id' => $conteptId,
            'data' => $contents
        ], 200);
    }
}
