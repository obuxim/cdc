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
    Route::get('/', 'PagesController@admin')->name('admin.dashboard');
    // Categories Route
    Route::prefix('services')->group(function(){
        Route::get('/', 'CategoriesController@index')->name('admin.category.index');
        Route::get('/new', 'CategoriesController@create')->name('admin.category.create');
        Route::post('/new', 'CategoriesController@store')->name('admin.category.store');
        Route::get('/show/{id}', 'CategoriesController@show')->name('admin.category.show');
        Route::get('/edit/{id}', 'CategoriesController@edit')->name('admin.category.edit');
        Route::post('/edit/{id}', 'CategoriesController@update')->name('admin.category.update');
        Route::get('/delete/{id}', 'CategoriesController@destroy')->name('admin.category.destroy');
    });
    // Services Route
    Route::prefix('items')->group(function(){
        Route::get('/', 'ServicesController@index')->name('admin.service.index');
        Route::get('/new', 'ServicesController@create')->name('admin.service.create');
        Route::post('/new', 'ServicesController@store')->name('admin.service.store');
        Route::get('/show/{id}', 'ServicesController@show')->name('admin.service.show');
        Route::get('/edit/{id}', 'ServicesController@edit')->name('admin.service.edit');
        Route::post('/edit/{id}', 'ServicesController@update')->name('admin.service.update');
        Route::get('/delete/{id}', 'ServicesController@destroy')->name('admin.service.destroy');
    });
});
