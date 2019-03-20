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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group([
//    'prefix'     => 'admin',
//    'namespace'  => 'Api'
//], function () {
//    Route::group(['namespace' => 'Admin'], function () {
             /*
             *    Login Route
             */
        Route::post('admin/login', 'Api\Admin\AuthController@login');
        Route::post('admin/register', 'Api\Admin\AuthController@register');
        Route::post('admin/user', 'Api\Admin\AuthController@userInformation');

//    });
//});
