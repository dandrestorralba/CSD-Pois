<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routest
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/{service}', 'ApiController@index');

Route::get('/{service}/poiMasCercano/{x}/{y}', 'ApiController@poiMasCercano');

