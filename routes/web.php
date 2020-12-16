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
Route::get('error', 'HomeController@notActive');
Route::get('failure', 'HomeController@failure');
Route::get('dashboard', 'HomeController@dashboard');
Route::get('parameters', 'ParameterController@index');
Route::post('parameters', 'ParameterController@save');
Route::post('parameter/save', 'ParameterController@saveTable');
Route::get('safeaccount', 'SafeController@index');
Route::post('safeaccount', 'SafeController@arama');
Route::post('safeaccount/new', 'SafeController@save');
Route::post('safe/ajax/save', 'SafeController@ajax');
Route::get('safe/delete/{id}', 'SafeController@delete');
Route::get('safedata/delete/{id}', 'SafeDataController@delete');
Route::get('ajax/mainclass', 'AjaxController@mainClass');
Route::post('safedata/{id?}', 'SafeDataController@save');
Route::post('safe/approve', 'SafeController@saveApprove');
Route::get('incoming', 'IncomingController@index');
Route::post('incoming', 'IncomingController@arama');
Route::post('incomingdata/{id?}', 'IncomingController@save');
Route::post('incoming/ajax/save', 'IncomingController@ajax');
Route::get('incoming/delete/{id}', 'IncomingController@delete');
Route::get('customer/delete/{id}', 'CustomerController@delete');
Route::get('param/delete/{ptype}/{id}', 'ParameterController@delete');
Route::get('document/delete/{id}', 'DocController@delete');
Route::get('document/{type}/{type_id}', 'DocController@create');
Route::post('document/add', 'DocController@save');
Route::get('sifre', 'UserController@changePassword');
Route::post('sifre', 'UserController@changePass');
Route::get('expense', 'ExpenseDataController@index');
Route::post('expense', 'ExpenseDataController@arama');
Route::post('expensedata/{id?}', 'ExpenseDataController@save');
Route::get('report', 'ReportController@safeReport');
Route::post('report', 'ReportController@safeReportPost');
Route::get('reportt', 'ReportController@safeReportPostt');
Route::get('ajax/mainclasses', 'AjaxController@mainClasses');
Route::get('incomereport', 'ReportController@incomeReport');
Route::post('incomereport', 'ReportController@incomeReportPost');
Route::get('expensereport', 'ReportController@expenseReport');
Route::post('expensereport', 'ReportController@expenseReportPost');
Route::get('summaryreport', 'ReportController@summaryReport');
Route::post('summaryreport', 'ReportController@summaryReportPost');
