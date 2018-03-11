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
Route::get('projects', 'Project\ProjectController@index');

//List single Project
Route::get('project/{id}', 'Project\ProjectController@show');

//Create a new Project
Route::post('project', 'Project\ProjectController@store');

//update project
Route::put('project/{id}', 'Project\ProjectController@store');

//******** USER **************//
//delete User
Route::delete('user/{id}', 'User\UserController@destroy');

//List Users
Route::get('users', 'User\UserController@index');

//List single User
Route::get('user/{id}', 'User\UserController@show');

//Create a new User
Route::post('user', 'User\UserController@store');

//update User
Route::put('user/{id}', 'User\UserController@update');

//delete User
Route::delete('user/{id}', 'User\UserController@destroy');

//verify user token
Route::get('users/verify/{token}', 'User\UserController@verify')->name('verify');

//resend user token
Route::get('users/{id}/resend', 'User\UserController@resend')->name('resend');


//******** COMMENT **************//
//delete Comment
Route::delete('comment/{id}', 'Comment\CommentController@destroy');

//List Comments
Route::get('comments', 'Comment\CommentController@index');

//List single Comment
Route::get('comment/{id}', 'Comment\CommentController@show');

//Create a new Comment
Route::post('comment', 'Comment\CommentController@store');

//update Comment
Route::put('comment/{id}', 'Comment\CommentController@store');

//delete Comment
Route::delete('comment/{id}', 'Comment\CommentController@destroy');


//******** CATEGORIES **************//

//get list of categories
Route::get('categories', 'Category\CategoryController@index');

//******** LOGIN **************//

Route::post('oauth/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('oauth/token/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');


