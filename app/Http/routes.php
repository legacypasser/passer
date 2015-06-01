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

Route::post('register',['uses'=>'MateController@register']);

Route::post('login',['uses'=>'MateController@login']);

Route::get('recommend',[ 'uses'=>'PostController@recommend']);

Route::get('search',['uses'=>'PostController@search']);

Route::get('personal',['uses'=>'PostController@personal']);

Route::get('detail',['uses'=>'PostController@detail']);

Route::post('publish', ['middleware'=>'mate', 'uses'=>'PostController@publish']);

Route::post('finish', ['middleware'=>'mate', 'uses'=>'TradeController@finish']);

Route::get('online', ['middleware'=>'mate', 'uses'=>'MessageController@offlineMessage']);

Route::post('chat', ['middleware'=>'mate', 'uses'=>'MessageController@chat']);

Route::post('interest', ['middleware'=>'mate', 'uses'=>'TradeController@interest']);

Route::get('info', ['uses'=>'MateController@info']);

Route::get('activate', ['uses'=>'MateController@active']);