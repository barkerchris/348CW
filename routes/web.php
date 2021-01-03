<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/posts', 'PostController@index')->name('posts.index')->middleware(['auth', 'verified']);
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware(['auth', 'verified']);
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware(['auth', 'verified']);
Route::get('/posts/{post}', 'PostController@show')->name('posts.show')->middleware(['auth', 'verified']);
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware(['auth', 'verified']);
Route::patch('/posts/{post}/edit', 'PostController@update')->name('posts.update')->middleware(['auth', 'verified']);
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware(['auth', 'verified']);

Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware(['auth', 'verified']);
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware(['auth', 'verified']);
Route::patch('/users/{user}/edit', 'UserController@update')->name('users.update')->middleware(['auth', 'verified']);
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy')->middleware(['auth', 'verified']);

Route::patch('/profilePictures/{profilePicture}/edit', 'ProfilePictureController@update')->name('profilePictures.update')->middleware(['auth', 'verified']);

Route::post('/attachments', 'AttachmentController@store')->name('attachments.store')->middleware(['auth', 'verified']);
Route::get('/attachments/{id}/{type}/create', 'AttachmentController@create')->name('attachments.create')->middleware(['auth', 'verified']);
Route::get('/attachments/{attachment}', 'AttachmentController@show')->name('attachments.show')->middleware(['auth', 'verified']);
Route::delete('/attachments/{id}/{type}/{attachment}', 'AttachmentController@destroy')->name('attachments.destroy')->middleware(['auth', 'verified']);

Route::get('/posts/{post}/comments', 'CommentController@page')->name('comments.page')->middleware(['auth', 'verified']);