<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Session;
use App\User;	
use App\Record;
use App\SelectRecord;

class SelectRecordController extends Controller
{
    public function select_sale()
    {
        $role = Sentinel::findRoleById(3);
        $sale_list = $role->users()->with('roles')->get();
        $sale_list_id = array();
        $n=0;
        foreach ($sale_list as $sale_list_each)
        {
            if(!(SelectRecord::is_selected_sale($sale_list_each->id)))
            {
                $sale_list_id[$n]=$sale_list_each->id;
            }
            $n++;
        }
        
        $new_sale_list = array();
        $n = 0;
        foreach ($sale_list_id as $sale_list_id_each)
        {
            $new_sale_list[$n] = Sentinel::findById($sale_list_id_each);
            $n++;
        }
    	 return view('admin.select.select_sale')->with('sale_list',$new_sale_list);
    }

    public function select_record($id)
    {
    	$sale = Sentinel::findUserById($id);
    	$record_list = Record::where('status','=','Available')->paginate(2);

    	return view('admin.select.select_record')->with('sale',$sale)->with('record_list',$record_list);
    }

    public function add_selected_record()
    {
        //Get data then input it to session array
    	$data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
    	//print_r($data);
        //Check session?
        if(session('mem_selected_record'))
        {
            $selected_array = session('mem_selected_record');
        }
    	$new_data = array_merge($selected_array,$new_data_array);
        session(['mem_selected_record' => $new_data]);
    	

    }

    public function remove_selected_record()
    {
        $data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
        if(session('mem_selected_record'))
        {
            $selected_array = session('mem_selected_record');
        }
        $new_data = array_diff($selected_array,$new_data_array);
        session(['mem_selected_record' => $new_data]);
    }

    public function reset_selected_record()
    {
        Session::forget('mem_selected_record');
    }

    public function preview_select_record(Request $request)
    {
        $selected_array = session('mem_selected_record');
        $selected_record_list = Record::whereIn('id',$selected_array)->get();
        $sale_id = $request->input('sale_id');
        $sale = Sentinel::findUserById($sale_id);

        session(['mem_selected_record_list'=>$selected_record_list]);//put select record
        session(['mem_sale'=>$sale]);

        return Redirect('/admin/selected_record/select_sale/preview');
        //return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
        
    }

    public function show_preview_select_record()
    {
        $sale = session('mem_sale');
        $selected_record_list = session('mem_selected_record_list');
        return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
    }

    public function submit_select_record(Request $request)
    {
        $sale = session('mem_sale');
        $selected_record_list = session('mem_selected_record_list');
        foreach($selected_record_list as $selected_record_each)
        {
            $dt = date("Y-m-d");
            $user = Sentinel::check();
            $select_record = new SelectRecord;
            $select_record->record_id = $selected_record_each->id;
            $select_record->sale_id =  $sale->id;
            $select_record->available_start = date("Y-m-d");
            $select_record->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
            $select_record->created_at = date("Y-m-d");
            $select_record->created_by = $user->id;
            $select_record->updated_at = date("Y-m-d");
            $select_record->updated_by =$user->id;
            $select_record->save();
            
        }
        return Redirect('/admin/selected_record/select_sale/success');
        
    }

    public function success_select_record()
    {
        //copy ข้อมูลที่อยู่ใน session เพิ้อไปแสดงผล
        $sale = session('mem_sale');
        Session::forget('mem_sale');
        Session::forget('mem_selected_record');
        Session::forget('mem_selected_record_list');
        //ทำการ ลบ ข้อมูลที่อยู่ใน session ออก
        return view('admin.select.success')->with('sale',$sale);
    }

}
