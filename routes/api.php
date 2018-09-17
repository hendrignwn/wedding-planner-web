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
//Route::get('trigger', function() {
//    $userRelations = App\UserRelation::get();
//    foreach ($userRelations as $userRelation) {
//        $userRelation->femaleUser->insertFirstContentData();
//    }
//});
Route::get('test', function() {
App\ProcedurePreparation::sendPushNotification();
});
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
    
    Route::get('/procedure', 'Api\RequestController@procedure');
    Route::get('/page/{category}', 'Api\RequestController@getPage');
    
    Route::group(['prefix' => 'vendor'], function () {
        Route::get('/', 'Api\VendorController@index');
        Route::get('/{id}', 'Api\VendorController@show');
    });
    
    Route::group(['middleware' => ['jwt.auth']], function () {
                       
        Route::group(['prefix' => 'contents'], function () {
            Route::get('/{conceptId}/{isCustomConcept}', 'Api\ContentController@index');
            Route::post('/store/{conceptId}/{isCustomConcept}', 'Api\ContentController@store');
            Route::patch('/update/{id}', 'Api\ContentController@update');
            Route::delete('/delete/{id}', 'Api\ContentController@delete');
        });
                       
        Route::group(['prefix' => 'concepts'], function () {
            Route::get('/', 'Api\ConceptController@index');
            Route::post('/store', 'Api\ConceptController@store');
            Route::patch('/update/{id}', 'Api\ConceptController@update');
            Route::delete('/delete/{id}', 'Api\ConceptController@delete');
        });
        
        Route::get('/costs', 'Api\UserController@costs');
        Route::get('/messages', 'Api\RequestController@listMessages');
        
        Route::group(['prefix' => 'procedure-administrations'], function () {
            Route::get('/', 'Api\ProcedureAdministrationController@index');
            Route::post('/', 'Api\ProcedureAdministrationController@store');
        });
        
        Route::group(['prefix' => 'procedure-payment'], function () {
            Route::get('/', 'Api\ProcedurePaymentController@index');
            Route::post('/', 'Api\ProcedurePaymentController@store');
            Route::patch('/{id}', 'Api\ProcedurePaymentController@update');
            Route::delete('/{id}', 'Api\ProcedurePaymentController@delete');
        });
        
        Route::group(['prefix' => 'procedure-preparation'], function () {
            Route::get('/', 'Api\ProcedurePreparationController@index');
            Route::post('/', 'Api\ProcedurePreparationController@store');
            Route::patch('/{id}', 'Api\ProcedurePreparationController@update');
            Route::delete('/{id}', 'Api\ProcedurePreparationController@delete');
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
            Route::patch('/update/relation/{code}', 'Api\UserController@updateRelation');
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
