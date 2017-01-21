<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
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
}
