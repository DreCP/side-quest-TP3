<?php
use App\Routes\Route;


/*Define the URLs and connect them to their controller methods */
Route::get('/', 'HomeController@index');

Route::get('/game/show', 'GameController@show');
Route::get('/game/create', 'GameController@create');
Route::post('/game/create', 'GameController@store');
Route::get('/game/edit', 'GameController@edit');
Route::post('/game/edit', 'GameController@update');
Route::post('/game/delete', 'GameController@delete');

Route::get('/platform/create', 'PlatformController@create');
Route::post('/platform/create', 'PlatformController@store');
Route::post('/platform/delete', 'PlatformController@delete');

Route::get('/login', 'AuthController@create');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::post('/wishlist/store', 'WishlistController@store');
Route::post('/wishlist/delete', 'WishlistController@delete');

Route::get('/visitlog', 'VisitLogController@index');

Route::dispatch();
