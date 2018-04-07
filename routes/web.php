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
Route::get('/test', function(){
    return view('test');
});

Route::get('/admin/login', ['as'=>'login','uses'=>'Admin\LoginController@index']);
Route::post('/admin/authenticate', 'Admin\LoginController@authenticate');
Route::get('/admin/logout', 'Admin\LoginController@logout');

Route::get('/admin/home', 'Admin\HomeController@index');

Route::get('/admin/profile', 'Admin\ProfileController@index');
Route::post('/admin/profile/update', 'Admin\ProfileController@update');
Route::post('/admin/profile/reset', 'Admin\ProfileController@reset');
Route::post('/admin/profile/upload', 'Admin\ProfileController@upload');

Route::get('/admin/system_info', 'Admin\SystemInfoController@index');
Route::post('/admin/system_info', 'Admin\SystemInfoController@update');

Route::get('/admin/menu', 'Admin\MenuController@index');
Route::get('/admin/menu/create', 'Admin\MenuController@create');
Route::get('/admin/menu/{id}', 'Admin\MenuController@edit');
Route::post('/admin/menu', 'Admin\MenuController@store');
Route::put('/admin/menu/{id}', 'Admin\MenuController@update');
Route::delete('/admin/menu/{id}', 'Admin\MenuController@destroy');

Route::get('/admin/role', 'Admin\RoleController@index');
Route::get('/admin/role/create', 'Admin\RoleController@create');
Route::get('/admin/role/{id}', 'Admin\RoleController@edit');
Route::post('/admin/role', 'Admin\RoleController@store');
Route::put('/admin/role/{id}', 'Admin\RoleController@update');
Route::delete('/admin/role/{id}', 'Admin\RoleController@destroy');
Route::get('/admin/role/{id}/power', 'Admin\RoleController@power');
Route::post('/admin/role/{id}/power', 'Admin\RoleController@empower');

Route::get('/admin/user', 'Admin\UserController@index');
Route::get('/admin/user/create', 'Admin\UserController@create');
Route::get('/admin/user/{id}', 'Admin\UserController@edit');
Route::post('/admin/user', 'Admin\UserController@store');
Route::put('/admin/user/{id}', 'Admin\UserController@update');
Route::delete('/admin/user/{id}', 'Admin\UserController@destroy');

Route::get('/admin/app', 'Admin\AppController@index');
Route::get('/admin/app/create', 'Admin\AppController@create');
Route::get('/admin/app/{id}', 'Admin\AppController@edit');
Route::post('/admin/app', 'Admin\AppController@store');
Route::put('/admin/app/{id}', 'Admin\AppController@update');
Route::delete('/admin/app/{id}', 'Admin\AppController@destroy');