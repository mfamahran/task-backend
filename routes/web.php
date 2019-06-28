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
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'auth'], function () {


	Route::get('product', ['as' => 'product.edit', 'uses' => 'ProductController@edit']);
	Route::put('product', ['as' => 'product.update', 'uses' => 'ProductController@update']);
	Route::resource('product', 'ProductController', ['except' => ['show']]);	

	Route::get('category', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
	Route::put('category', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
	Route::resource('category', 'CategoryController', ['except' => ['show']]);


});
