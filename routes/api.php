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

//Route::get('brand', 'CatalogueController@index');


Route::get('app', 'API\ParabaController@app');
Route::get('screen_transports', 'API\ParabaController@screen_transports')->name('screen_transports');
Route::get('screen_locations', 'API\ParabaController@screen_locations')->name('screen_locations');
Route::get('screen_posts', 'API\ParabaController@screen_posts')->name('screen_posts');

Route::get('list_transports', 'API\ParabaController@list_transports')->name('list_transports');
Route::get('list_locations', 'API\ParabaController@list_locations')->name('list_locations');
Route::get('list_posts', 'API\ParabaController@list_posts')->name('list_posts');

///API Authentication
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'API\Auth\AuthController@login')->name('login');
    Route::post('register', 'API\Auth\AuthController@register');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\Auth\AuthController@logout');
        Route::get('user', 'API\Auth\AuthController@user');
    });
});