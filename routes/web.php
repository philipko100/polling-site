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

//Pages is for Figures

Route::get('/', 'PagesController@index');

Route::get('/figures/create', 'PagesController@create');

Route::get('/figures/{id}', 'PagesController@show');

Route::post('/figures/store', 'PagesController@store');

Route::get('/about', 'PagesController@about');

Route::delete('/figure/destroy/{id}', 'PagesController@destroy');

Route::get('/figures/{id}/edit', 'PagesController@edit');

Route::put('/figures/{id}/update', 'PagesController@update');

//Searches

Route::get('/posts/search', 'SearchesController@search');

Route::get('/posts/search/figure', 'SearchesController@figureSearch');

//Posts

Route::resource('posts', 'PostsController');

//Comments

Route::resource('comments', 'CommentsController');

//Subcomments

Route::get('/comment/{id}/subcomments','SubcommentsController@index');

Route::post('/subcomment/store', 'SubcommentsController@store');

Route::get('/subcomments/{id}/edit', 'SubcommentsController@edit');

Route::put('/subcomments/{id}/update', 'SubcommentsController@update');

Route::delete('/subcomments/destroy/{id}', 'SubcommentsController@destroy');

//others

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');


