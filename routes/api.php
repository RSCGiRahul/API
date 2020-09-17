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
Route::post('signup', 'Api\RegisterController@signup');
Route::get('videos', 'Api\VideoController@index');
Route::get('my-videos/{fbId}', 'Api\VideoController@userVideos');
Route::post('comment', 'Api\VideoController@comment');

Route::get('video-comment/{videoId}', 'Api\VideoController@videoComment');
Route::get('section-music', 'Api\MusicController@index');
Route::post('favorites', 'Api\MusicController@favorites');
Route::get('user-fav-music/{userFbId}', 'Api\MusicController@userFavoriteMusic');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
