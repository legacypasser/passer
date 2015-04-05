<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::post('register','MateController@register');

Route::post('login','MateController@login');

Route::get('recommend','PostController@recommend');

Rotue::get('search','PostController@search');

Route::get('personal','PostController@personal');

Route::get('detail','PostController@detail');

Route::post('publish', 'PostController@publish');

Route::post('finish', 'TradeController@finish');

Route::get('offline', 'MessageController@offlineMessage');

Route::post('chat', 'MessageController@chat');


