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

Route::get('/', 'BooksController@index')->name('home');

Route::get('/books', 'BooksController@index')->name('books.index');
Route::post('/books', 'BooksController@store')->name('books.store')->middleware('check_admin');

Route::get('/books/create', 'BooksController@create')->name('books.create')->middleware('check_admin');

// Route::get('/books/{book}', 'BooksController@show')->name('books.show')->middleware('auth');
Route::get('/books/{book}', 'BooksController@show')->name('books.show')->middleware('auth');
Route::put('/books/{book}', 'BooksController@update')->name('books.update')->middleware('check_admin');
Route::delete('/books/{book}', 'BooksController@destroy')->name('books.destroy')->middleware('check_admin');

Route::get('/books/{book}/edit', 'BooksController@edit')->name('books.edit')->middleware('check_admin');

Route::get('/collection','CollectionsController@index')->name('collection.index')->middleware('check_auth');

Route::put('/collection/{book}/add','CollectionsController@add')->name('collection.add')->middleware('check_auth');
Route::put('/collection/{book}/remove','CollectionsController@remove')->name('collection.remove')->middleware('check_auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
