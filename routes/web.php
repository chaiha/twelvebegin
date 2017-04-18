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

Route::get('/test_date','AdminController@test_date');
Route::get('/create_user_admin','UserController@create_user_admin');
Route::get('/create_user_sale','UserController@create_user_sale');
Route::get('/create_user_super','UserController@create_user_super');
Route::post('/login', 'UserController@login');
Route::get('logout', 'UserController@logout');
Route::get('/check', 'UserController@checkdi');

//--super admin 
Route::get('/super/home','SuperController@index')->middleware('super');
Route::get('/super/record/list_records','SuperController@list_records');
Route::get('/super/record/create_new_record', 'SuperController@create_new_record');
Route::post('/super/record/create_new_record', 'SuperController@preview_new_record');
Route::get('/super/record/preview_new_record', 'SuperController@show_preview_new_record');
Route::post('/super/record/preview_new_record', 'SuperController@submit_new_record');
Route::get('/super/record/edit_new_record','SuperController@edit_new_record');
Route::get('/super/record/success_create_new_reocord','SuperController@success_new_record');

Route::get('/super/record/edit_record/{id}','SuperController@get_edit_record');
Route::post('/super/record/edit_record/','SuperController@preview_edit_record');
Route::get('/super/record/preview_edit_record','SuperController@show_preview_edit_record');
Route::post('/super/record/preview_edit_record','SuperController@submit_edit_record');
Route::get('/super/record/success_edit_reocord','SuperController@success_edit_reocord');

Route::get('/super/record/delete_record/{id}','SuperController@get_delete_record');
Route::post('/super/record/delete_record/','SuperController@submit_delete_record');
Route::get('/super/record/success_delete_record','SuperController@success_delete_record');

//---------select record for sale --------------------
Route::get('/super/select_record/list_selected_sale','SuperController@list_selected_sale');
Route::get('/super/select_record/show_selected_record/{sale_id}','SuperController@show_selected_record_list');

Route::get('/super/select_record/select_sale','SuperController@select_sale');
Route::get('/super/select_record/select_sale/{id}','SuperController@select_record');

Route::get('/super/selected_record/reset_selected_record','SuperController@reset_selected_record');
Route::post('/super/selected_record/add_selected_record','SuperController@add_selected_record');
Route::post('/super/selected_record/remove_selected_record','SuperController@remove_selected_record');
Route::post('/super/selected_record/select_sale/','SuperController@preview_select_record');
Route::get('/super/selected_record/select_sale/preview','SuperController@show_preview_select_record');
Route::post('/super/selected_record/select_sale/preview','SuperController@submit_select_record');
Route::get('/super/selected_record/select_sale/success','SuperController@success_select_record');

//---------- Setting value
Route::get('/super/setting/index','SuperController@get_setting');
Route::get('/super/setting/edit_setting/{id}','SuperController@get_edit_setting');
Route::post('/super/setting/edit_setting/','SuperController@submit_edit_setting');
Route::get('/super/edit_redcord/success_edit_setting','SuperController@show_succes_edit_setting');

//--------- Show sale performace 
Route::get('/super/show_sale_performance/list_sale','SuperController@list_sale_perform');
Route::get('/super/show_sale_perform/select_sale/{sale_id}','SuperController@show_sale_perform');
Route::post('/super/show_sale_perform/show_sale_perform_by_range','SuperController@show_sale_perform_by_range');
Route::post('/super/show_sale_perform/export_excel_sale_perform','SuperController@export_excel_sale_perform');

//--admin
Route::get('/earnings','AdminController@earnings')->middleware('admin');
Route::get('/admin/checkupdate','AdminController@check_is_update')->middleware('admin');
Route::get('/admin/test_cookie','AdminController@test_cookie');
Route::get('/admin/forget_cookie','AdminController@forget_cookie');
Route::get('/admin/home','AdminController@index')->middleware('admin');
Route::get('/admin/record/list_records','AdminController@list_records');
Route::get('/admin/record/create_new_record', 'AdminController@create_new_record');

// record list
Route::get('/admin/record/create_new_record_list','AdminController@create_new_record_list');
Route::post('/admin/reocord/preview_new_record_list','AdminController@preview_new_record_list');
Route::get('/admin/record/show_preview_new_record_list','AdminController@show_preview_new_record_list');
Route::get('/admin/record/edit_duplicate_new_record_list/{id_array}','AdminController@edit_duplicate_new_record_list');
Route::post('/admin/record/submit_edit_duplicate_new_record_list','AdminController@submit_edit_duplicate_new_record_list');
Route::get('/admin/record/edit_new_record_list','AdminController@edit_new_record_list');
Route::post('/admin/record/edit_new_record_list','AdminController@submit_edit_new_record_list');
Route::get('/admin/record/delete_edit_new_record_list/{id_array}','AdminController@delete_new_record_list');
Route::post('/admin/record/show_preview_new_record_list','AdminController@submit_new_record_list');
Route::get('/admin/record/success_new_record_list','AdminController@show_success_new_record_list');


Route::post('/admin/record/create_new_record', 'AdminController@preview_new_record');
Route::get('/admin/record/preview_new_record', 'AdminController@show_preview_new_record');
Route::post('/admin/record/preview_new_record', 'AdminController@submit_new_record');
Route::get('/admin/record/edit_new_record','AdminController@edit_new_record');
Route::get('/admin/record/success_create_new_reocord','AdminController@success_new_record');

Route::get('/admin/record/edit_record/{id}','AdminController@get_edit_record');
Route::post('/admin/record/edit_record/','AdminController@preview_edit_record');
Route::get('/admin/record/preview_edit_record','AdminController@show_preview_edit_record');
Route::post('/admin/record/preview_edit_record','AdminController@submit_edit_record');
Route::get('/admin/record/success_edit_reocord','AdminController@success_edit_reocord');

//---------select record for sale --------------------
Route::get('/admin/select_record/select_sale','AdminController@select_sale');
Route::get('/admin/select_record/select_sale/{id}','AdminController@select_record');
Route::get('/admin/select_record/select_sale/filter_extend/{sale_id}','AdminController@filter_extend_select_record');
Route::get('/admin/select_record/select_sale/filter_waiting/{sale_id}','AdminController@filter_waiting_select_record');
Route::get('/admin/select_record/select_sale/filter_noreply/{sale_id}','AdminController@filter_noreply_select_record');
Route::get('/admin/select_record/select_sale/filter_new_record/{sale_id}','AdminController@filter_new_select_record');
Route::get('/admin/select_record/show_selected_list_sale/{sale_id}','AdminController@show_selected_list_sale');


Route::get('/admin/selected_record/reset_selected_record','AdminController@reset_selected_record');
//Extend
Route::post('/admin/selected_record/add_selected_record_extend','AdminController@add_selected_record_extend');
Route::post('/admin/selected_record/remove_selected_record_extend','AdminController@remove_selected_record_extend');
//Waiting
Route::post('/admin/selected_record/add_selected_record_waiting','AdminController@add_selected_record_waiting');
Route::post('/admin/selected_record/remove_selected_recshord_waiting','AdminController@remove_selected_record_waiting');
//No reply
Route::post('/admin/selected_record/add_selected_record_noreply','AdminController@add_selected_record_noreply');
Route::post('/admin/selected_record/remove_selected_record_noreply','AdminController@remove_selected_record_noreply');
//New record
Route::post('/admin/selected_record/add_selected_record_new','AdminController@add_selected_record_new');
Route::post('/admin/selected_record/remove_selected_record_new','AdminController@remove_selected_record_new');


Route::post('/admin/selected_record/select_sale/','AdminController@preview_select_record');
Route::get('/admin/selected_record/select_sale/preview','AdminController@show_preview_select_record');
Route::post('/admin/selected_record/select_sale/preview','AdminController@submit_select_record');
Route::get('/admin/selected_record/select_sale/success/{sale_id}','AdminController@success_select_record');
Route::post('/admin/selected_record/select_sale/remove_record_from_selected_list','AdminController@remove_record_form_selected_list');

//Approve record from sale
Route::get('/admin/approve_record_from_sale/show_sale_list','AdminController@show_sale_list');
Route::get('/admin/approve_record_from_sale/select_sale/{sale_id}','AdminController@show_waiting_approve');
Route::get('/admin/approve_record_from_sale/show_record_detail/{record_id}','AdminController@show_record_detail');
Route::post('/admin/approve_record_from_sale/show_record_detail','AdminController@submit_approve_record');
Route::post('/admin/approve_record_from_sale/select_sale/','AdminController@submit_all_approve_record');

//Export date to excel file
Route::get('/admin/export_excel/list_lot_no','AdminController@list_lot_no');
Route::get('/admin/export_excel/show_selected_lot_no/{lot_no}','AdminController@show_lot_no');
Route::get('/admin/export_excel/export_excel/{lot_no}','AdminController@export_excel_by_lot_no');

//------End Admin

// Route::get('/admin/create_new_record', 'RecordController@preview_new_record');
// Route::get('/admin/edit/{id}','AdminController@get_edit_record');

Route::get('/sale/home','CallController@index');
Route::get('/sale/show_selected_record_list','CallController@show_list_record');
Route::get('/sale/select_record/call/{id}','CallController@select_record_call');
Route::post('/sale/select_record/preview_filled_record','CallController@preview_filled_record');
Route::get('/sale/select_record/show_preview_filled_record','CallController@show_preview_filled_record');
Route::post('/sale/select_record/show_preview_filled_record','CallController@submit_filled_record');
Route::post('/sale/select_record/edit_preview_filled_record','CallController@edit_filled_record');
Route::get('/sale/select_record/show_edit_preview_filled_record','CallController@show_edit_filled_record');
Route::post('/sale/select_record/submit_edit_filled_record','CallController@submit_edit_call_record');
Route::get('/sale/select_record/call/success/{id}','CallController@call_success');
Route::post('/sale/show_selected_record_list','CallController@submit_allresult_selected_record');
Route::get('/sale/select_record/edit_record/{record_id}','CallController@edit_submit_record');
Route::post('/sale/select_record/edit_record/','CallController@preview_edit_submit_record');
Route::get('/sale/select_record/show_preview_edit_submit_record','CallController@show_preview_edit_submit_record');
Route::post('/sale/select_record/show_preview_edit_submit_record','CallController@submit_edit_submit_record');
Route::get('/sale/select_record/cancel_edit_submit_record','CallController@cancel_edit_submit_record');
Route::get('/sale/select_record/submit_ediit_submit_record/success/{record_id}','CallController@success_edit_submit_record');

Route::get('/sale/edit_record/record/show/{record_id}','CallController@edit_record_info');
Route::post('/sale/edit_record/record/preview','CallController@preview_edit_record_info');
Route::get('/sale/edit_record/record/show_preview_edit_info','CallController@show_preview_edit_info');
Route::get('/sale/edit_record/record/edit_record_info/{record_id}','CallController@edit_preview_info');
Route::post('/sale/edit_record/record/submit_edit_record_info','CallController@submit_edit_record_info');
Route::get('/sale/edit_record/record/success_edit_info','CallController@success_edit_info');
Route::get('/sale/edit_record/record/cancel_edit_record','CallController@cancel_edit_info');