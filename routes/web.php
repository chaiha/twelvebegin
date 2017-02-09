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
Route::get('/create_user_sale','UserController@create_user_sale');
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

//---------select record for sale --------------------
Route::get('/admin/select_record/select_sale','SelectRecordController@select_sale');
Route::get('/admin/select_record/select_sale/{id}','SelectRecordController@select_record');

Route::get('/admin/selected_record/reset_selected_record','SelectRecordController@reset_selected_record');
Route::post('/admin/selected_record/add_selected_record','SelectRecordController@add_selected_record');
Route::post('/admin/selected_record/remove_selected_record','SelectRecordController@remove_selected_record');
Route::post('/admin/selected_record/select_sale/','SelectRecordController@preview_select_record');
Route::get('/admin/selected_record/select_sale/preview','SelectRecordController@show_preview_select_record');
Route::post('/admin/selected_record/select_sale/preview','SelectRecordController@submit_select_record');
Route::get('/admin/selected_record/select_sale/success','SelectRecordController@success_select_record');

// Route::get('/admin/create_new_record', 'RecordController@preview_new_record');
// Route::get('/admin/edit/{id}','AdminController@get_edit_record');

Route::get('/sale/home','CallController@index');
Route::get('/sale/show_selected_record_list','CallController@show_list_record');
Route::get('/sale/select_record/call/{id}','CallController@select_record_call');
Route::get('/sale/select_record/preview_filled_record','CallController@preview_filled_record');