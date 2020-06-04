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



// Route::resource('/post', 'PostController');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

/**********Posts********************/
Route::get('/posts', [
	'uses' => 'PostController@index',
	'as' => 'posts'
		]);

	Route::get('/post/create', [
	'uses' => 'PostController@create',
	'as' => 'post.create'
		]);
 	Route::post('/post/store', [
 	'uses' => 'PostController@store',
 	'as' => 'post.store'
 		]);
 	Route::get('/post/edit/{id}', [
	'uses' => 'PostController@edit',
	'as' => 'post.edit'
		]);
 	Route::get('/post/delete/{id}', [
	'uses' => 'PostController@destroy',
	'as' => 'post.delete'
		]);
 	Route::post('/post/update/{id}', [
	'uses' => 'PostController@update',
	'as' => 'post.update'
		]);


/************Categories******************/

 	Route::get('/category/create', [
	'uses' => 'CategoryController@create',
	'as' => 'category.create'
		]);
 	Route::post('/category/store', [
	'uses' => 'CategoryController@store',
	'as' => 'category.store'
		]);
 	Route::get('/categories', [
	'uses' => 'CategoryController@index',
	'as' => 'categories'
		]);
 	Route::get('/category/edit/{id}', [
	'uses' => 'CategoryController@edit',
	'as' => 'category.edit'
		]);
 	Route::get('/category/delete/{id}', [
	'uses' => 'CategoryController@destroy',
	'as' => 'category.delete'
		]);
 	Route::post('/category/update/{id}', [
	'uses' => 'CategoryController@update',
	'as' => 'category.update'
		]);

});

