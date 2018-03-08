<?php

namespace App\Http\Controllers\Api;

use App\Concept;
use App\Http\Controllers\Controller;
use App\Page;
use App\Procedure;
use Illuminate\Http\Request;

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
}
