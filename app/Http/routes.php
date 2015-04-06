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

Route::get('recommend',['middleware'=>'mate', 'uses'=>'PostController@recommend']);

Route::get('search',['middleware'=>'mate', 'uses'=>'PostController@search']);

Route::get('personal',['middleware'=>'mate', 'uses'=>'PostController@personal']);

Route::get('detail',['middleware'=>'mate', 'uses'=>'PostController@detail']);

Route::post('publish', ['middleware'=>'mate', 'uses'=>'PostController@publish']);

Route::post('finish', ['middleware'=>'mate', 'uses'=>'TradeController@finish']);

Route::get('online', ['middleware'=>'mate', 'uses'=>'MessageController@offlineMessage']);

Route::post('chat', ['middleware'=>'mate', 'uses'=>'MessageController@chat']);

Route::post('interest', ['middleware'=>'mate', 'uses'=>'TradeController@interest']);
