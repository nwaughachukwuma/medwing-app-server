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


Route::post('/marker', 'MapsController@storeMarker');
Route::get('/markers', 'MapsController@fetchMarkers');
Route::put('/marker/{marker}', 'MapsController@updateMarker');
Route::delete('/marker/{marker}', 'MapsController@deleteMarker');


Route::post('/google_translate', 'GoogleTranslateController@translate');
