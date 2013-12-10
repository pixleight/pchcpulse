<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('token', '[A-Za-z0-9]{6}');
$token_pattern = '[a-zA-Z0-9]{6}';

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('user', 'UserController');
Route::resource('message', 'MessageController', array( 'only' => array( 'store' ) ) );
Route::resource('thread', 'ThreadController', array( 'except' => array( 'index', 'update', 'show' ) ) );
Route::resource('department', 'DepartmentController');

Route::get('thread/{thread_token}/{user_token}', 'ThreadController@show')
	->where(array(
		'thread_token' => $token_pattern,
		'user_token' => $token_pattern
	));

Route::get('thread/confirm/{thread_token}/{user_token}/{auth_token}', 'ThreadController@confirm')
	->where(array(
		'thread_token' => $token_pattern,
		'user_token' => $token_pattern,
		'auth_token' => '[a-zA-Z0-9]{16}'
	));