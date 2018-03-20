<?php

namespace App\Http\Controllers\Api;

use App\Concept;
use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\Message;
use App\Page;
use App\Procedure;
use App\ReportProblem;
use Illuminate\Http\Request;
use JWTAuth;

class RequestController extends Controller
{
    /**
     * @param Request $request
     * @return type
     */
    public function listConcepts(Request $request)
    {
        $models = Concept::actived()->ordered()->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
    
    /**
     * @param Request $request
     * @return type
     */
    public function listMessages(Request $request)
    {
        $models = Message::actived()->orderBy('message_at', 'desc')->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
    
    /**
     * @param Request $request
     * @return type
     */
    public function procedure(Request $request)
    {
        $model = Procedure::actived()->first();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'link' => Procedure::destinationPathUrl(),
            'data' => $model,
        ], 200);
    }
    
    /**
     * @param Request $request
     * @return type
     */
    public function getPage($category)
    {
        $model = Page::whereCategory($category)->first();
        if (!$model) {
            $model = [];
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $model
        ], 200);
    }
    
    public function storeReportProblem(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'category' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $reportProblem = new ReportProblem();
        $reportProblem->user_id = $user->id;
        $reportProblem->category = $request->category;
        $reportProblem->description = $request->description;
        $reportProblem->status = ReportProblem::STATUS_ACTIVE;
        $reportProblem->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Terima kasih telah meluangkan waktu Anda untuk melaporkan masalah pada Aplikasi ini.',
            'data' => []
        ], 201);
    }
}
