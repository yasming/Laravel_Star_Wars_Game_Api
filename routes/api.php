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

Route::post('/login', 'LoginController@authenticate');
Route::post('/register', 'RegisterController@store');

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'planets'], function () {

    Route::post('/visit/{planet}', 'ApiController@visitPlanet');
    Route::post('/search', 'ApiController@searchPlanet');
    Route::get('/visitors', 'ApiController@showPlanetsVistors');
    Route::get('/visitors/ranking', 'ApiController@showVisitorsRanking');

});
