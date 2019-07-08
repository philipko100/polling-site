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
Route::get('/hello', function () {
    //return view('welcome');
    return '<h1>Hello World</h1>';
});

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'This is user '.$name.' with id of '.$id;
});

*/
Route::get('/vue', function() {
    return view('welcome',
    ['title' => "An even cooler way to do the title"]);
});

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

Route::resource('posts', 'PostsController');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

/*
Route::get('/getsounds'){
    $sounds_like = '';
	$sounds_like.= metaphone('COMM 292'.' ');
	$sounds_like.= metaphone('Tracey'.' ');
	$sounds_like.= metaphone('Gurton'.' ');
	$sounds_like.= metaphone('winter term 1'.' ');
	$sounds_like.= metaphone('offline'.' ');
	$sounds_like.= metaphone('Commerce - Sauder'.' ');
	$sounds_like.= metaphone('University of British Columbia'.' ');

	echo $sounds_like;
}*/

