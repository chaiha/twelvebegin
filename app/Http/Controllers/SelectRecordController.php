<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Sentinel;
use Session;
use User;	
use App\Record;

class SelectRecordController extends Controller
{
    public function select_sale()
    {
    	$role = Sentinel::findRoleById(3);
    	$sale_list = $role->users()->with('roles')->get();
    	return view('admin.select.select_sale')->with('sale_list',$sale_list);
    }

    public function select_record($id)
    {
    	$sale = Sentinel::findUserById($id);
    	$record_list = Record::where('status','=','Available')->paginate(100);

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
}
