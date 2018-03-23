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
    Route::get('/page/{category}', 'Api\RequestController@getPage');
    
    Route::group(['middleware' => ['jwt.auth']], function () {
        
        Route::group(['prefix' => 'contents'], function () {
            Route::get('/{conceptId}', 'Api\ContentController@index');
            Route::post('/store/{conceptId}', 'Api\ContentController@store');
            Route::patch('/update/{id}', 'Api\ContentController@update');
            Route::delete('/delete/{id}', 'Api\ContentController@delete');
        });
        
        Route::get('/costs', 'Api\UserController@costs');
        Route::get('/messages', 'Api\RequestController@listMessages');
        
        Route::group(['prefix' => 'vendor'], function () {
            Route::get('/', 'Api\VendorController@index');
            Route::get('/{id}', 'Api\VendorController@show');
        });
        
        Route::group(['prefix' => 'content-details'], function () {
            Route::get('/{contentId}', 'Api\ContentDetailController@index');
            Route::post('/store/{contentId}', 'Api\ContentDetailController@store');
            Route::patch('/update/{id}', 'Api\ContentDetailController@update');
            Route::delete('/delete/{id}', 'Api\ContentDetailController@delete');
        });
        
        Route::group(['prefix' => 'content-detail-lists'], function () {
            Route::get('/{contentDetailId}', 'Api\ContentDetailListController@index');
            Route::post('/store/{contentDetailId}', 'Api\ContentDetailListController@store');
            Route::delete('/delete/{id}', 'Api\ContentDetailListController@delete');
        });
        
        Route::post('report-problem', 'Api\RequestController@storeReportProblem');
        
        Route::group(['prefix' => 'user'], function () {
            Route::get('/show/{code}', 'Api\UserController@show');
            Route::patch('/update/{code}', 'Api\UserController@update');
            Route::post('/upload-photo/{code}', 'Api\UserController@updatePhoto');
            Route::delete('/delete-photo/{code}', 'Api\UserController@deletePhoto');
            Route::patch('/re-send-relation/{id}', 'Api\UserController@resendRegisterRelation');
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
