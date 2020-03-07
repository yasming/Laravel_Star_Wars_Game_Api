<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'planet'], function () {

    Route::post('/visit/{planet}', 'ApiController@visitPlanet');
    Route::post('/search', 'ApiController@searchPlanet');
    Route::get('/visitors', 'ApiController@showPlanetsVistors');
    Route::get('/visitors/ranking', 'ApiController@showVisitorsRanking');

});
