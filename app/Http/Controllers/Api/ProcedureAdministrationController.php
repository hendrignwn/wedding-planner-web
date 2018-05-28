<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\Procedure;
use App\ProcedureAdministration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProcedureAdministrationController extends Controller
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
        
        $models = Procedure::actived()
                ->ordered()
                ->get();
        
        $result = [];
        $no = 0;
        foreach ($models as $model) {
            $result[$no] = $model;
            $administrations = ProcedureAdministration::where('procedure_id', $model->id)
                    ->where('user_relation_id', $user->userRelation->id)
                    ->first();
            $result[$no]['procedure_administrations'] = $administrations;
            $no++;
        }
        
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
            'procedure_id' => 'required|exists:procedure,id',
            'checklist' => 'required:|in:'.ProcedureAdministration::CHECKLIST_TRUE.','.ProcedureAdministration::CHECKLIST_FALSE,
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = ProcedureAdministration::where('procedure_id', $request->procedure_id)
                    ->where('user_relation_id', $user->userRelation->id)
                    ->first();
        if (!$model) {
            $model = new ProcedureAdministration();
            $model->procedure_id = $request->procedure_id;
            $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
            $model->created_at = Carbon::now()->toDateTimeString();
        }
        $model->user_id = $user->id;
        $model->checklist = $request->checklist;
        $model->updated_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = Procedure::actived()
                ->ordered()
                ->get();
        
        $result = [];
        $no = 0;
        foreach ($models as $model) {
            $result[$no] = $model;
            $administrations = ProcedureAdministration::where('procedure_id', $model->id)
                    ->where('user_relation_id', $user->userRelation->id)
                    ->first();
            $result[$no]['procedure_administrations'] = $administrations;
            $no++;
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'Saved',
            'data' => $models
        ], 200);
        
    }
}
