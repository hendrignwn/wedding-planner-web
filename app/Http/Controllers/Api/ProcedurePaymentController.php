<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\Procedure;
use App\ProcedureAdministration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProcedurePaymentController extends Controller
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
        
        $models = \App\ProcedurePayment::where('user_relation_id', $user->userRelation->id)
                ->orderBy('created_at', 'desc')
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
            'account_number' => 'nullable',
            'account_bank' => 'nullable',
            'account_holder' => 'nullable',
            'payment_total' => 'required',
            'installment_total_1' => 'nullable',
            'installment_total_2' => 'nullable',
            'installment_total_3' => 'nullable',
            'installment_date_1' => 'nullable',
            'installment_date_2' => 'nullable',
            'installment_date_3' => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = new \App\ProcedurePayment();
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->account_number = $request->account_number;
        $model->account_bank = $request->account_bank;
        $model->account_holder = $request->account_holder;
        $model->payment_total = $request->payment_total;
        $model->installment_total_1 = $request->installment_total_1;
        $model->installment_total_2 = $request->installment_total_2;
        $model->installment_total_3 = $request->installment_total_3;
        $model->installment_date_1 = $request->installment_date_1;
        $model->installment_date_2 = $request->installment_date_2;
        $model->installment_date_3 = $request->installment_date_3;
        $model->description = $request->description;
        $model->created_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = \App\ProcedurePayment::where('user_relation_id', $user->userRelation->id)
                ->orderBy('created_at', 'desc')
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
            'account_number' => 'nullable',
            'account_bank' => 'nullable',
            'account_holder' => 'nullable',
            'payment_total' => 'required',
            'installment_total_1' => 'nullable',
            'installment_total_2' => 'nullable',
            'installment_total_3' => 'nullable',
            'installment_date_1' => 'nullable',
            'installment_date_2' => 'nullable',
            'installment_date_3' => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $model = \App\ProcedurePayment::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->user_relation_id = $user->userRelation ? $user->userRelation->id : 0;
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->account_number = $request->account_number;
        $model->account_bank = $request->account_bank;
        $model->account_holder = $request->account_holder;
        $model->payment_total = $request->payment_total;
        $model->installment_total_1 = $request->installment_total_1;
        $model->installment_total_2 = $request->installment_total_2;
        $model->installment_total_3 = $request->installment_total_3;
        $model->installment_date_1 = $request->installment_date_1;
        $model->installment_date_2 = $request->installment_date_2;
        $model->installment_date_3 = $request->installment_date_3;
        $model->description = $request->description;
        $model->created_at = Carbon::now()->toDateTimeString();
        $model->save();
        
        $models = \App\ProcedurePayment::where('user_relation_id', $user->userRelation->id)
                ->orderBy('created_at', 'desc')
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
        
        $model = \App\ProcedurePayment::find($id);
        if (!$model) {
            return response()->json([
				'status' => 400,
				'message' => 'Something wrong',
			], 400);
        }
        $model->delete();
        $models = \App\ProcedurePayment::where('user_relation_id', $user->userRelation->id)
                ->orderBy('created_at', 'desc')
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Deleted',
            'data' => $models
        ], 200);
    }
}
