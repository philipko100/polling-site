<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


---
*/

Route::get('/', 'PagesController@index');

Route::get('/figures/create', 'PagesController@create');

Route::get('/figures/{id}', 'PagesController@show');

Route::post('/figures/store', 'PagesController@store');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::delete('/figure/destroy/{id}', 'PagesController@destroy');

Route::get('/figures/{id}/edit', 'PagesController@edit');

Route::put('/figures/{id}/update', 'PagesController@update');

Route::get('/posts/search', 'SearchesController@search');

Route::get('/posts/search/figure', 'SearchesController@figureSearch');

Route::resource('posts', 'PostsController');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');


