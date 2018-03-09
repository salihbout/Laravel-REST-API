<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//******** PROJECT **************//
//List Projects
Route::get('projects', 'ProjectController@index');

//List single Project
Route::get('project/{id}', 'ProjectController@show');

//Create a new Project
Route::post('project', 'ProjectController@store');

//update project
Route::put('project/{id}', 'ProjectController@store');

//******** USER **************//
//delete User
Route::delete('user/{id}', 'UserController@destroy');

//List Users
Route::get('users', 'UserController@index');

//List single User
Route::get('user/{id}', 'UserController@show');

//Create a new User
Route::post('user', 'UserController@store');

//update User
Route::put('user/{id}', 'UserController@update');

//delete User
Route::delete('user/{id}', 'UserController@destroy');

//verify user token
Route::get('users/verify/{token}', 'UserController@verify')->name('verify');

//resend user token
Route::get('users/{id}/resend', 'UserController@resend')->name('resend');


//******** COMMENT **************//
//delete Comment
Route::delete('comment/{id}', 'commentController@destroy');

//List Comments
Route::get('comments', 'commentController@index');

//List single Comment
Route::get('comment/{id}', 'commentController@show');

//Create a new Comment
Route::post('comment', 'commentController@store');

//update Comment
Route::put('comment/{id}', 'commentController@store');

//delete Comment
Route::delete('comment/{id}', 'commentController@destroy');



//******** LOGIN **************//

Route::post('oauth/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('oauth/token/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');


