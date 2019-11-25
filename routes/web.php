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

Route::get('/posts/search/figure', 'SearchesController@figureSearch')->name('search.figure');

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

//saving post

Route::post('/post/save', 'SavedPostsController@store');

Route::get('profile/{id}/saved', 'SavedPostsController@index');

Route::delete('/post/saved/destroy/{id}', 'SavedPostsController@destroy');

//saving comments

Route::post('/post/save/comment', 'SavedCommentsController@store');

Route::delete('/post/saved/destroy/comment/{id}', 'SavedCommentsController@destroy');

//user profile
Route::get('/profile/{id}', 'UsersController@show');

Route::get('/profile/username/{id}', 'UsersController@usernameShow');

Route::get('/profile/{id}/edit', 'UsersController@edit');

Route::put('/profile/update', 'UsersController@update');


//Authentication (User login, registration, forgot password)

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@index');

// sign in through provider e.g. google

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Report Bugs

//Route::get('/reportbugs', 'ReportBugsController@index')->name('reportbugs.index');

Route::get('/reportbugs/create', 'ReportBugsController@create')->name('reportbugs.create');

Route::post('/reportbugs/store', 'ReportBugsController@store')->name('reportbugs.store');

Route::get('/reportbugs/index', 'ReportBugsController@index')->name('reportbugs.index');

// Feedback & Recommendation feature

Route::get('/feedbacks/create', 'FeedbacksController@create')->name('feedbacks.create');

Route::post('/feedbacks/store', 'FeedbacksController@store')->name('feedbacks.store');

Route::get('/feedbacks/index', 'FeedbacksController@index')->name('feedbacks.index');

// Complaint feature

Route::get('/complaints/create', 'ComplaintsController@create')->name('complaints.create');

Route::post('/complaints/store', 'ComplaintsController@store')->name('complaints.store');

Route::get('/complaints/index', 'ComplaintsController@index')->name('complaints.index');

// Political Definition page

Route::get('/politicaldefinitions', function() {
    return view('politicaldefinitions');
})->name('politicaldefinitions');