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

Route::get('/admin/login', ['as'=>'login','uses'=>'Admin\LoginController@index']);
Route::post('/admin/authenticate', 'Admin\LoginController@authenticate');
Route::get('/admin/logout', 'Admin\LoginController@logout');
Route::get('/admin/home', 'Admin\HomeController@index');