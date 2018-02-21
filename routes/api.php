<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * with validation Content Type: application/json
 */
Route::group(['prefix' => 'v1'], function () {
    
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', 'Api\AuthController@register');
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/forgot-password', 'Api\AuthController@forgotPassword');
        
        Route::group(['middleware' => ['jwt.auth']], function () {
            Route::post('/change-password/{code}', 'Api\AuthController@changePassword');
            Route::post('/logout', 'Api\AuthController@logout');
        });
    });
    
    Route::get('/concepts', 'Api\RequestController@listConcepts');
    
    Route::group(['middleware' => ['jwt.auth']], function () {
        
        Route::group(['prefix' => 'user'], function () {
            Route::get('/show/{code}', 'Api\UserController@show');
        });
    });
    
});

/**
 * without validation Content Type: application/json
 */
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register-counselor-upload-files', 'Api\AuthController@registerCounselorUploadFiles');
    });
    
    Route::group(['prefix' => 'payment'], function () {
        Route::get('info-code', 'Api\Midtrans\PaymentController@infoCode');
        Route::post('/checkout', 'Api\Midtrans\PaymentController@checkout');
        
        Route::post('/notification', 'Api\Midtrans\PaymentController@notification');
    });
});