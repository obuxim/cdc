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
//Profile Route
Route::get('/profile','ProfileController@index')->middleware('auth')->name('user.profile');
Route::post('/profile','ProfileController@update')->middleware('auth')->name('user.profile.update');
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
    // Customers Route
    Route::prefix('customers')->group(function(){
        Route::get('/', 'CustomersController@index')->name('admin.customer.index');
        Route::get('/new', 'CustomersController@create')->name('admin.customer.create');
        Route::post('/new', 'CustomersController@store')->name('admin.customer.store');
        Route::get('/show/{id}', 'CustomersController@show')->name('admin.customer.show');
        Route::get('/edit/{id}', 'CustomersController@edit')->name('admin.customer.edit');
        Route::post('/edit/{id}', 'CustomersController@update')->name('admin.customer.update');
        Route::get('/delete/{id}', 'CustomersController@destroy')->name('admin.customer.destroy');
    });
});
