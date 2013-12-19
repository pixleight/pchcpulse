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

Route::get('/', 'ThreadController@create');

Route::group(array('before'=>'auth'), function() {   
	Route::resource('user', 'UserController');
	Route::resource('department', 'DepartmentController');
});

Route::resource('message', 'MessageController', array( 'only' => array( 'store' ) ) );
Route::resource('thread', 'ThreadController', array( 'except' => array( 'index', 'update', 'show' ) ) );
Route::get( 'thread', 'ThreadController@create' );

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

Route::get('login', 'UserController@login');
Route::post('login', 'UserController@doLogin');

Route::get('logout', function()
{
	Auth::logout();
	Session::flash( 'flash_type', 'success' );
	Session::flash( 'flash_message', 'You have been logged out.' );
	return Redirect::route('thread.create');
});