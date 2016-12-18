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

Route::get('/test', function () {
    return view('pages.one');
});

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/create_user','UserController@create_user');
Route::post('/login', 'UserController@login');
Route::get('logout', 'UserController@logout');
Route::get('/check', 'UserController@checKdi');
Route::get('/earnings','AdminController@earnings')->middleware('admin');
Route::get('/admin/create_new_record', 'AdminController@create_new_record');
Route::get('/admin/edit/{id}','AdminController@get_edit_record');