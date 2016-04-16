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

Route::get('/', ['middleware' => 'auth.basic', function() 
{
    return view('welcome');
}]);

Route::group(array('prefix' => 'api/v1', 'middleware' => 'auth.basic'), function()
{
	Route::get('name', ['uses' => 'PostsController@getPageName']);
	Route::get('posts', ['uses' => 'PostsController@getPosts']);
});
