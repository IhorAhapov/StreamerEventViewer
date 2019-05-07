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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')
    ->where('provider', 'twitch')
    ->name('socialLogin');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')
    ->where('provider', 'twitch')
    ->name('socialCallback');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'StreamerController@index')->name('dashboard');
    Route::get('streamer/{streamer}', 'StreamerController@show')->name('showStreamer');
    Route::delete('streamer/{streamer}', 'StreamerController@delete')->name('deleteStreamer');
    Route::post('streamer', 'StreamerController@addToFavorite')->name('addStreamer');
});

Route::prefix('webhook')->group(function () {
    Route::get('streamer/{streamer}/event/{type}', 'EventController@accept')->name('twitchEventCallbackConfirm');
    Route::post('streamer/{streamer}/event/{type}', 'EventController@store')->name('twitchEventCallbackHandle');
});



