<?php

namespace App\Http\Controllers\Api;

use App\Concept;
use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\UserRelationConcept;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ConceptController extends Controller
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
        
        $models = Concept::actived()->ordered()->get();
        $userRelationConcepts = UserRelationConcept::where('user_relation_id', $user->userRelation->id)
                ->actived()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models,
            'concepts' => $userRelationConcepts
        ], 200);
    }
    
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = new UserRelationConcept();
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->created_at = Carbon::now()->toDateTimeString();
        $model->save();
        $model->afterCreateAutoCreateContent();
        
        $models = UserRelationConcept::where('user_relation_id', $user->userRelation->id)
                ->actived()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Saved',
            'data' => $models
        ], 200);
    }
    
    public function update($id, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = UserRelationConcept::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->updated_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = UserRelationConcept::where('user_relation_id', $user->userRelation->id)
                ->actived()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Updated',
            'data' => $models
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
        
        $model = UserRelationConcept::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->delete();
        $models = UserRelationConcept::where('user_relation_id', $user->userRelation->id)
                ->actived()
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Deleted',
            'data' => $models
        ], 200);
    }
}
