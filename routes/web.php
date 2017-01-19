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
Route::get('/check', 'UserController@checkdi');
Route::get('/earnings','AdminController@earnings')->middleware('admin');
Route::get('/admin/home','AdminController@index')->middleware('admin');
Route::get('/admin/record/list_records','RecordController@list_records');
Route::get('/admin/record/create_new_record', 'RecordController@create_new_record');
Route::post('/admin/record/create_new_record', 'RecordController@preview_new_record');
Route::get('/admin/record/preview_new_record', 'RecordController@show_preview_new_record');
Route::post('/admin/record/preview_new_record', 'RecordController@submit_new_record');
Route::get('/admin/record/edit_new_record','RecordController@edit_new_record');
Route::get('/admin/record/success_create_new_reocord','RecordController@success_new_record');

Route::get('/admin/record/edit_record/{id}','RecordController@get_edit_record');
Route::post('/admin/record/edit_record/','RecordController@preview_edit_record');
Route::get('/admin/record/preview_edit_record','RecordController@show_preview_edit_record');
Route::post('/admin/record/preview_edit_record','RecordController@submit_edit_record');
Route::get('/admin/record/success_edit_reocord','RecordController@success_edit_reocord');

// Route::get('/admin/create_new_record', 'RecordController@preview_new_record');
// Route::get('/admin/edit/{id}','AdminController@get_edit_record');