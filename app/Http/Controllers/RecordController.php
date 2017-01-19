<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use User;	
use App\Record;

class RecordController extends Controller
{
	public function list_records()
    {
    	$records = Record::paginate(100);
    	return view('admin.record.list_records')->with('records',$records);
    }
    public function create_new_record()
    {
    	
    	return view('admin.record.create_new_record');
        
    }
    public function preview_new_record(Request $request)
    {
    	$record = array();
    	$latest_no = Record::latest('id')->first();
    	$record['no']= $latest_no->no;
		$record['code'] = $request->input('code');
		$record['status'] = $request->input('status');
		// $effective_date = $request->input('effective_date');
		$record['sources'] = $request->input('sources');
		$record['categories'] = $request->input('categories');
		$record['dtac_type'] = $request->input('dtac_type');
		$record['input_date'] = date("Y-m-d");
		//$distributed_date = $request->input('distributed_date');
		//$deadline = $request->input('deadline');
		$record['sale'] = $request->input('sale');
		$record['name_th'] = $request->input('name_th');
		$record['name_en'] = $request->input('name_en');
		$record['branch'] = $request->input('branch');
		$record['address'] = $request->input('address');
		$record['contact_tel'] = $request->input('contact_tel');
		$record['latitude'] = $request->input('latitude');
		$record['longitude'] = $request->input('longitude');
		$record['shop_type'] = $request->input('shop_type');
		$record['contact_person'] = $request->input('contact_person');
		$record['contact_email'] = $request->input('contact_email');
		$record['contact_day'] = $request->input('contact_day');
		$record['contact_month'] = $request->input('contact_month');
		$record['contact_year'] = $request->input('contact_year');
		$record['province'] = $request->input('province');
		$record['links'] = $request->input('links');
		$record['remarks'] = $request->input('remarks');

		session(['new_record' => $record]);

		return redirect('/admin/record/preview_new_record');

    }
    public function show_preview_new_record()
    {
    	$preview_record = session('new_record');
    	return view('admin.record.preview_new_record')->with('record',$preview_record);
    }

    public function edit_new_record()
    {
    	$edit_record = session('record');
    	return view('admin.record.edit_new_record')->with('record',$edit_record);
    }

    public function submit_new_record(Request $request)
    {
    	$record = new Record;
    	$record->no= $request->input('no');
		$record->code = $request->input('code');
		$record->status = $request->input('status');
		$record->sources = $request->input('sources');
		$record->categories = $request->input('categories');
		$record->dtac_type = $request->input('dtac_type');
		$record->input_date = date("Y-m-d");
		//$distributed_date = $request->input('distributed_date');
		//$deadline = $request->input('deadline');
		$record->sale = $request->input('sale');
		$record->name_th = $request->input('name_th');
		$record->name_en = $request->input('name_en');
		$record->branch = $request->input('branch');
		$record->address = $request->input('address');
		$record->contact_tel = $request->input('contact_tel');
		$record->latitude = $request->input('latitude');
		$record->longitude = $request->input('longitude');
		$record->shop_type = $request->input('shop_type');
		$record->contact_person = $request->input('contact_person');
		$record->contact_email = $request->input('contact_email');
		$contact_date = $request->input('contact_year')."-".$request->input('contact_day')."-".$request->input('contact_month');
		$record->contact_date = $contact_date;
		
		$record->province = $request->input('province');
		$record->links = $request->input('links');
		$record->remarks = $request->input('remarks');
		$record->created_by ="chai";
		$record->created_at = date("Y-m-d H:i:s");
		$record->updated_by ="chai";
		$record->updated_at = date("Y-m-d H:i:s");
		$record->save();

		return redirect('/admin/record/success_create_new_reocord');
    }

    public function success_new_record()
    {
    	return view('admin.record.success_new_record');
    }

     public function get_edit_record($id)
    {
    	$record = Record::find($id);
    	return view('admin.record.edit_record')->with('record',$record);
    }

    public function preview_edit_record(Request $request)
    {

    	$record = array();
    	$record['id'] = $request->input('id');
    	$record['no']= $request->input('no');
		$record['code'] = $request->input('code');
		$record['status'] = $request->input('status');
		// $effective_date = $request->input('effective_date');
		$record['sources'] = $request->input('sources');
		$record['categories'] = $request->input('categories');
		$record['dtac_type'] = $request->input('dtac_type');
		$record['input_date'] = date("Y-m-d");
		//$distributed_date = $request->input('distributed_date');
		//$deadline = $request->input('deadline');
		$record['sale'] = $request->input('sale');
		$record['name_th'] = $request->input('name_th');
		$record['name_en'] = $request->input('name_en');
		$record['branch'] = $request->input('branch');
		$record['address'] = $request->input('address');
		$record['contact_tel'] = $request->input('contact_tel');
		$record['latitude'] = $request->input('latitude');
		$record['longitude'] = $request->input('longitude');
		$record['shop_type'] = $request->input('shop_type');
		$record['contact_person'] = $request->input('contact_person');
		$record['contact_email'] = $request->input('contact_email');
		$record['contact_day'] = $request->input('contact_day');
		$record['contact_month'] = $request->input('contact_month');
		$record['contact_year'] = $request->input('contact_year');
		$record['province'] = $request->input('province');
		$record['links'] = $request->input('links');
		$record['remarks'] = $request->input('remarks');

		session(['edit_record' => $record]);

		return redirect('/admin/record/preview_edit_record');
    }
    public function show_preview_edit_record()
    {
    	$preview_record = session('edit_record');
    	return view('admin.record.preview_edit_record')->with('record',$preview_record);
    }
    public function submit_edit_record(Request $request)
    {
    	$record_id = $request->input('record_id');

    	$record = Record::where('id','=',$record_id)->first() ;
    	$record->no= $request->input('no');
		$record->code = $request->input('code');
		$record->status = $request->input('status');
		$record->sources = $request->input('sources');
		$record->categories = $request->input('categories');
		$record->dtac_type = $request->input('dtac_type');
		$record->input_date = date("Y-m-d");
		//$distributed_date = $request->input('distributed_date');
		//$deadline = $request->input('deadline');
		$record->sale = $request->input('sale');
		$record->name_th = $request->input('name_th');
		$record->name_en = $request->input('name_en');
		$record->branch = $request->input('branch');
		$record->address = $request->input('address');
		$record->contact_tel = $request->input('contact_tel');
		$record->latitude = $request->input('latitude');
		$record->longitude = $request->input('longitude');
		$record->shop_type = $request->input('shop_type');
		$record->contact_person = $request->input('contact_person');
		$record->contact_email = $request->input('contact_email');
		$contact_date = $request->input('contact_year')."-".$request->input('contact_day')."-".$request->input('contact_month');
		$record->contact_date = $contact_date;
		
		$record->province = $request->input('province');
		$record->links = $request->input('links');
		$record->remarks = $request->input('remarks');
		$record->created_by ="chai";
		$record->created_at = date("Y-m-d H:i:s");
		$record->updated_by ="chai";
		$record->updated_at = date("Y-m-d H:i:s");
		$record->save();

		return redirect('/admin/record/success_edit_reocord');
    }

    public function success_edit_reocord()
    {
    	return view('admin.record.success_edit_record');
    }

}
