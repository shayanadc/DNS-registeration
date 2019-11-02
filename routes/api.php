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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/users/current', 'UserController@getAuthenticatedUser');
Route::post('/login', 'UserController@login');
Route::resource('/users', 'UserController');
Route::middleware('auth:api')->resource('/domains', 'DomainController');
Route::middleware('auth:api')->resource('/records', 'RecordTypeController');
