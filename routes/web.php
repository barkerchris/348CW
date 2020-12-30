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
});

Auth::routes(['verify' => true]);

Route::get('/posts', 'PostController@index')->name('posts.index')->middleware(['auth', 'verified']);
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware(['auth', 'verified']);
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware(['auth', 'verified']);
Route::get('/posts/{post}', 'PostController@show')->name('posts.show')->middleware(['auth', 'verified']);
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware(['auth', 'verified']);
Route::patch('/posts/{post}/edit', 'PostController@update')->name('posts.update')->middleware(['auth', 'verified']);
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware(['auth', 'verified']);