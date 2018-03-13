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



// Users
Route::resource('users', 'User\UserController');
Route::resource('users.projects', 'User\UserProjectController',['only'=>['index']]);
Route::resource('users.comments', 'User\UserCommentController',['only'=>['index']]);

// Projects
Route::resource('projects', 'Project\ProjectController');
Route::resource('projects.comments', 'Project\ProjectCommentController',['only'=>['index']]);
Route::resource('projects.user', 'Project\ProjectUserController',['only'=>['index']]);
Route::resource('projects.categories', 'Project\ProjectCategoryController',['only'=>['index', 'update', 'destroy']]);

// Comments
Route::resource('comments', 'Comment\CommentController');
Route::resource('comments.user', 'Comment\CommentUserController', ['only' =>['index']]);


// Categories
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.projects', 'Category\CategoryProjectController', ['only'=>['index']]);




//******** LOGIN **************//

Route::post('oauth/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('oauth/token/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');




