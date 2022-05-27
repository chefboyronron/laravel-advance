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

Route::view('/', 'home');
Route::view('about', 'about')->middleware('test');

Route::get('contact', 'ContactFormController@create');
Route::post('contact', 'ContactFormController@store');

// 7 resource controllers
// Route::get('customers', 'CustomersController@index');
// Route::get('customers/create', 'CustomersController@create');
// Route::post('customers', 'CustomersController@store');
// Route::get('customers/{customer}', 'CustomersController@show');
// Route::get('customers/{customer}/edit', 'CustomersController@edit');
// Route::patch('customers/{customer}', 'CustomersController@update');
// Route::delete('customers/{customer}', 'CustomersController@delete');

// Simplified resources route
// Route::resource('customers', 'CustomersController')->middleware('auth');

/** 2 types of authentication via middleware
 * Authenticate page route with middleware
 *  - show login page if not logged-in
 * 1. via route level
 * - Route::resource('customers', 'CustomersController')->middleware('auth');
 * 2. via controller level
 * - in __construct() add $this->middleware('auth')
 * - please refer in the CustomerController
 */
Route::resource('customers', 'CustomersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
