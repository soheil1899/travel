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

Route::namespace('App\Http\Controllers\Client')->group(function () {
    Route::get('/', 'IndexController@index');

    Route::get('/category/{id}/{title}', 'IndexController@category');

    Route::get('/place/{id}/{title}', 'IndexController@place');

    Route::get('/videos', 'IndexController@videos');
    Route::get('/video/{id}/{title}', 'IndexController@video');


    Route::get('/place-gallery/{id}', 'PlaceController@placeGallery');
    Route::get('/place-like/{id}', 'PlaceController@placeLike');
    Route::get('/get-comment/{id}', 'PlaceController@getComment');
    Route::get('/comment-like/{id}', 'PlaceController@commentLike');
    Route::post('/save-comment', 'PlaceController@saveComment');


    Route::get('/search', 'IndexController@search');
    Route::post('/searching', 'IndexController@searching');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/', 'AdminController@index')->name('master');
    Route::get('/get-setting', 'AdminController@getSetting');
    Route::get('/get-count', 'AdminController@getCount');
    Route::post('/change-setting', 'AdminController@changeSetting');


    Route::get('/user-list', 'UserController@userList');
    Route::post('/save-user', 'UserController@saveUser');
    Route::delete('/delete-user/{id}', 'UserController@deleteUser');

    Route::get('/category-list', 'CategoryController@categoryList');
    Route::post('/save-category', 'CategoryController@saveCategory');
    Route::delete('/delete-category/{id}', 'CategoryController@deleteCategory');

    Route::get('/comment-list', 'CommentController@commentList');
    Route::get('/change-comment-publish/{id}/{publish}', 'CommentController@changeCommentPublish');
    Route::post('/change-comment-content', 'CommentController@changeCommentContent');
    Route::delete('/delete-comment/{id}', 'CommentController@deleteComment');

    Route::get('/movie-list', 'MovieController@movieList');
    Route::post('/save-movie', 'MovieController@saveMovie');
    Route::delete('/delete-movie/{id}', 'MovieController@deleteMovie');
    Route::post('/save-movie-image', 'MovieController@saveMovieImage');

    Route::get('/place-list', 'PlaceController@placeList');
    Route::post('/save-place', 'PlaceController@savePlace');
    Route::delete('/delete-place/{id}', 'PlaceController@deletePlace');
    Route::get('/place-gallery/{id}', 'PlaceController@placeGallery');
    Route::post('/save-place-gallery', 'PlaceController@savePlaceGallery');

    Route::post('/delete-gallery', 'PlaceController@deleteGallery');

});
