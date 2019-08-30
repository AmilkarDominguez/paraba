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
    return view('welcome');
});

//Auth
Auth::routes();

///USERS///////

Route::get('/users', 'UserController@user')->name('user')->middleware('auth');
Route::resource('user', 'UserController')->except(['create','show']);
Route::get('listuser', 'UserController@list')->name('listuser')->middleware('auth');

//HOME
Route::get('/home', 'HomeController@index')->name('home');
/////CATALOGUES/////////
//Catalogues Controllers
Route::resource('catalogues', 'CatalogueController')->except(['create','show']);
Route::get('catalogues_datatable', 'CatalogueController@datatable')->name('catalogues_datatable')->middleware('auth');
Route::get('list_catalogue', 'CatalogueController@list')->name('list_catalogue')->middleware('auth');
//Catalogues views
Route::get('country', 'CatalogueController@country')->name('country')->middleware('auth');
Route::get('document_type', 'CatalogueController@document_type')->name('document_type')->middleware('auth');
Route::get('occupation', 'CatalogueController@occupation')->name('occupation')->middleware('auth');
Route::get('language', 'CatalogueController@language')->name('language')->middleware('auth');
Route::get('tag', 'CatalogueController@tag')->name('tag')->middleware('auth');
Route::get('transport_type', 'CatalogueController@transport_type')->name('transport_type')->middleware('auth');
Route::get('location_type', 'CatalogueController@location_type')->name('location_type')->middleware('auth');
//
Route::resource('transports', 'TransportController')->middleware('auth');
Route::get('transports_datatable', 'TransportController@datatable')->middleware('auth');

