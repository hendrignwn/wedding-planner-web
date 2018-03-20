<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $vendors = Vendor::actived()->ordered()->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $vendors
        ], 200);
    }
    
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function show($id)
    {
        $vendors = Vendor::whereId($id)->actived()->first();
        if (!$vendors) {
            return response()->json([
                'status' => 404,
                'message' => 'vendor is not found.',
                'data' => [],
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $vendors
        ], 200);
    }
}
