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
Route::post('signup', 'RegisterController@signup');

Route::get('section-music', 'MusicController@index');
Route::post('favorites', 'MusicController@favorites');
Route::get('user-fav-music/{userFbId}', 'MusicController@userFavoriteMusic');


Route::get('discover', 'DiscoverController@index');


Route::get('videos', 'VideoController@index');
Route::get('my-videos/{fbId}', 'VideoController@userVideos');
Route::post('comment', 'VideoController@comment');
Route::get('video-comment/{videoId}', 'VideoController@videoComment');
Route::get('detail/{fbId}', 'UserController@detail');
Route::get('followers/{fbId}', 'UserController@followers');
Route::get('follow/{fbId}', 'UserController@follow');
Route::post('user/update', 'UserController@update');


Route::get('user-liked-videos/{userFbId}', 'VideoController@userLikedVideos');
Route::get('video/search/{string?}', 'VideoController@search');
Route::post('update-video-status/{fbId}/{videoId}', 'VideoController@updateVideoStatus');
Route::post('video/view', 'VideoController@view');


//Route::group('prefix')


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
