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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('logout', 'HomeController@logout');
// Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'Admin\FirmsController@index');
Route::post('admin', 'Admin\FirmsController@save');
Route::get('admin/delete/{firmid}', 'Admin\FirmsController@delete');
Route::get('admin/users', 'Admin\UsersController@index');
Route::post('admin/users', 'Admin\UsersController@save');
Route::get('admin/delete/{firmid}', 'Admin\FirmsController@delete');
