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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/statics/account', 'AccountController@statics');
Route::get('/statics/community', 'CommunityController@statics');
Route::get('/activity', 'ActivityController@info');
Route::get('/activity/account', 'ActivityController@account');
Route::get('/activity/community', 'ActivityController@community');
Route::get('/activity/create', 'ActivityController@creation');
Route::get('/activity/background', 'ActivityController@background');
Route::get('/account/follow', 'AccountController@follow');
Route::get('/account/info', 'AccountController@info');
Route::get('/account/avatar', 'AccountController@avatar');
Route::get('/community/search', 'CommunityController@search');
Route::get('/community/moment', 'CommunityController@moment');
Route::get('/community/follow', 'CommunityController@follow');
Route::get('/community/follow', 'CommunityController@follow');

Route::post('/community/release', 'CommunityController@release');
Route::post('/community/comment', 'CommunityController@comment');
Route::post('/activity/create/confirm', 'ActivityController@confirmCreation');
Route::post('/activity/join', 'ActivityController@join');
Route::post('/activity/cancel', 'ActivityController@cancel');

Route::resource('activity/resource', 'ResourceController');