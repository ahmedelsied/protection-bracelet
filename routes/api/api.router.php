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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    Route::group(['prefix' => 'hardware', 'namespace' => 'Hardware'], function(){
        Route::get('/esp/save','ESPController@index');
    });
    Route::get('/test-esp', 'IndexController@index');
    Route::group(['namespace' => 'Child', 'prefix' => 'child', 'as' => 'child.'], function () {
        Route::get('/bracelet/{bracelet}/filter', 'BraceletController@filter')->name('bracelet.filter');
        Route::get('/bracelet/{bracelet}/sync', 'BraceletController@syncBraceletMeasurement')->name('bracelet.sync');
    });
});
