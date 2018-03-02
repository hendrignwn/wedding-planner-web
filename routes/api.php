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
        Route::post('/register-invitation', 'Api\AuthController@registerInvitation');
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/forgot-password', 'Api\AuthController@forgotPassword');
        Route::post('/reset-password', 'Api\AuthController@resetPassword');
        
        Route::group(['middleware' => ['jwt.auth']], function () {
            Route::post('/change-password/{code}', 'Api\AuthController@changePassword');
            Route::post('/logout', 'Api\AuthController@logout');
        });
    });
    
    Route::get('/concepts', 'Api\RequestController@listConcepts');
    Route::get('/procedure', 'Api\RequestController@procedure');
    Route::get('/about-us', 'Api\RequestController@aboutUs');
    Route::get('/term-of-use', 'Api\RequestController@termOfUse');
    
    Route::group(['middleware' => ['jwt.auth']], function () {
        
        Route::get('/contents/{conceptId}', 'Api\ContentController@index');
        
        Route::get('/costs', 'Api\UserController@costs');
        
        Route::get('/content-details/{contentId}', 'Api\ContentDetailController@index');
        Route::patch('/content-details/update/{id}', 'Api\ContentDetailController@update');
        
        Route::get('/content-detail-lists/{contentDetailId}', 'Api\ContentDetailListController@index');
        Route::post('/content-detail-lists/{contentDetailId}', 'Api\ContentDetailListController@store');
        Route::patch('/content-detail-lists/{id}', 'Api\ContentDetailListController@update');
        Route::delete('/content-detail-lists/{id}', 'Api\ContentDetailListController@delete');
        
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