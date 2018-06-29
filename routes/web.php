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

Route::get('/', 'HomeController@index');
Route::get('/topics', 'HomeController@topic');
Route::get('/ticket', 'HomeController@index');
Route::get('/ticket/{id}', 'HomeController@showTicket');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'DashboardController@profile');
Route::get('/profile/info', 'DashboardController@profile');
Route::post('/profile/info', 'DashboardController@updateInfo');
Route::post('/profile/update-picture', 'DashboardController@updatePictureProfile');
Route::post('/profile', 'DashboardController@updateProfile');
Route::get('/my-ticket', 'DashboardController@listTicket');
Route::post('/my-ticket', 'DashboardController@createTicket');
Route::get('/my-ticket/delete/{id}', 'DashboardController@deleteTicket');
Route::get('/category', 'CategoryController@index');
Route::post('/category', 'CategoryController@create');
Route::post('/category/update', 'CategoryController@update');
Route::get('/category/delete/{id}', 'CategoryController@delete');
Route::post('/reply','DashboardController@reply');
Route::get('/like/{id}','DashboardController@like');
Route::get('/unlike/{id}','DashboardController@unlike');