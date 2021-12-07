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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/', 'AdminController@index')->name('master');


    Route::get('/user-list', 'UserController@userList');
    Route::post('/save-user', 'UserController@saveUser');
    Route::delete('/delete-user/{id}', 'UserController@deleteUser');

    Route::get('/category-list', 'CategoryController@categoryList');
    Route::post('/save-category', 'CategoryController@saveCategory');
    Route::delete('/delete-category/{id}', 'CategoryController@deleteCategory');
});
