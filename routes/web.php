<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('test', function () {
    return "<a href='agendanikah://register-relation?token=111'>Register</a><a href='http://agendanikah.com/register-relation?token=111'>Register</a><a href='agendanikah.com/register-relation?token=111'>Register</a>";
});

Route::get('/register-relation/{token}', 'Web\\SiteController@registerRequest');
Route::post('/register-relation', 'Web\\SiteController@proccessRegisterRequest');
Route::get('/reset-your-password', 'Web\\SiteController@resetPassword');
Route::post('/reset-your-password', 'Web\\SiteController@proccessResetPassword');

Route::get('/success', 'Web\\SiteController@success');

/**
 * Admin Routes
 */
Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\DashboardController@index']);
    
    Route::get('/user/profile', ['as' => 'user.profile', 'uses' => 'Admin\UserController@profile']);
    Route::post('/user/profile', ['as' => 'user.profile', 'uses' => 'Admin\UserController@updateProfile']);
    
    Route::get('/concept/data', ['as' => 'concept.data', 'uses' => 'Admin\\ConceptController@listIndex']);
	Route::resource('/concept', 'Admin\\ConceptController');
    
    Route::get('/user/data', ['as' => 'user.data', 'uses' => 'Admin\\UserController@listIndex']);
	Route::resource('/user', 'Admin\\UserController');
    
    Route::get('/user-app/data', ['as' => 'user-app.data', 'uses' => 'Admin\\UserAppController@listIndex']);
	Route::resource('/user-app', 'Admin\\UserAppController');
    
    Route::get('/user-relation/data', ['as' => 'user-relation.data', 'uses' => 'Admin\\UserRelationController@listIndex']);
    Route::get('/concept/user-data/{userRelationId}', ['as' => 'concept.user-data', 'uses' => 'Admin\\UserRelationController@listConceptsIndex']);
	Route::resource('/user-relation', 'Admin\\UserRelationController');
    
    Route::get('/procedure/data', ['as' => 'procedure.data', 'uses' => 'Admin\\ProcedureController@listIndex']);
	Route::resource('/procedure', 'Admin\\ProcedureController');
    
    Route::get('/term-of-use/data', ['as' => 'term-of-use.data', 'uses' => 'Admin\\TermOfUseController@listIndex']);
	Route::resource('/term-of-use', 'Admin\\TermOfUseController');
    
    Route::get('/about-us/data', ['as' => 'about-us.data', 'uses' => 'Admin\\AboutUsController@listIndex']);
	Route::resource('/about-us', 'Admin\\AboutUsController');
    
    Route::get('/content/data/{id}/{userRelationId}', ['as' => 'content.data', 'uses' => 'Admin\\ContentController@listIndex']);
    Route::get('/content/{id}/{userRelationId}', ['as' => 'content.index', 'uses' => 'Admin\\ContentController@index']);
    Route::get('/content/{id}', ['as' => 'content.show', 'uses' => 'Admin\\ContentController@show']);
    
    Route::get('/content-detail/data/{id}', ['as' => 'content-detail.data', 'uses' => 'Admin\\ContentDetailController@listIndex']);
    Route::get('/content-detail/{id}', ['as' => 'content-detail.show', 'uses' => 'Admin\\ContentDetailController@show']);
    
    Route::get('/content-detail-list/data/{id}', ['as' => 'content-detail-list.data', 'uses' => 'Admin\\ContentDetailListController@listIndex']);
    Route::get('/content-detail-list/{id}', ['as' => 'content-detail-list.show', 'uses' => 'Admin\\ContentDetailListController@show']);
    
    Route::get('/vendor/data', ['as' => 'vendor.data', 'uses' => 'Admin\\VendorController@listIndex']);
	Route::resource('/vendor', 'Admin\\VendorController');
    
    Route::get('/vendor-detail/data/{id}', ['as' => 'vendor-detail.data', 'uses' => 'Admin\\VendorDetailController@listIndex']);
	Route::resource('/vendor-detail', 'Admin\\VendorDetailController');
    
    Route::get('/message/data', ['as' => 'message.data', 'uses' => 'Admin\\MessageController@listIndex']);
	Route::resource('/message', 'Admin\\MessageController');
});