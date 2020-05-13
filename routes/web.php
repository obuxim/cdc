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
    return view('index');
})->name('customer.home');


Auth::routes();
// Admin Routes
Route::prefix('admin')->middleware('isAdmin')->group(function(){
    // Categories Route
    Route::prefix('categories')->group(function(){
        Route::get('/', 'CategoriesController@index')->name('admin.category.index');
        Route::get('/new', 'CategoriesController@create')->name('admin.category.create');
        Route::get('/show/{id}', 'CategoriesController@show')->name('admin.category.show');
        Route::get('/edit/{id}', 'CategoriesController@edit')->name('admin.category.edit');
        Route::get('/delete/{id}', 'CategoriesController@destroy')->name('admin.category.destroy');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
