<?php

namespace App\Http\Controllers\Api;

use App\Concept;
use App\Helpers\FormatConverter;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\User;
use File;
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
}
