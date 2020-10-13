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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// public api
Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function(){
    Route::post('/auth/login', 'AuthController@login');
    Route::get('/auth/logout', 'AuthController@logout');
});

// private api
Route::group(['middleware' => 'auth:api', 'namespace' => 'Api\v1', 'prefix' => 'v1'], function(){
    Route::group(['middleware' => ['role:board']], function () {
        Route::post('/user', 'UserController@register');
    });
});    