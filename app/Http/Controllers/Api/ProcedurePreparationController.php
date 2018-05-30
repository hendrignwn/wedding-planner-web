<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\Procedure;
use App\ProcedureAdministration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProcedurePreparationController extends Controller
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
        
        $models = \App\ProcedurePreparation::where('user_relation_id', $user->userRelation->id)
                ->orderBy('preparation_at', 'desc')
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
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
            'venue' => 'required',
            'preparation_at' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = new \App\ProcedurePreparation();
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->venue = $request->venue;
        $model->preparation_at = $request->preparation_at;
        $model->created_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = \App\ProcedurePreparation::where('user_relation_id', $user->userRelation->id)
                ->orderBy('preparation_at', 'desc')
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
            'venue' => 'required',
            'preparation_at' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = \App\ProcedurePreparation::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->venue = $request->venue;
        $model->preparation_at = $request->preparation_at;
        $model->updated_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = \App\ProcedurePreparation::where('user_relation_id', $user->userRelation->id)
                ->orderBy('preparation_at', 'desc')
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
        
        $model = \App\ProcedurePreparation::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->delete();
        $models = \App\ProcedurePreparation::where('user_relation_id', $user->userRelation->id)
                ->orderBy('preparation_at', 'desc')
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Deleted',
            'data' => $models
        ], 200);
    }
}
