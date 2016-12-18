<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;

class AdminController extends Controller
{
    public function earnings()
    {
    	return "result 9999";
    }

    public function create_new_record()
    {
    	return view('admin.create_new_record');
    }

    public function get_edit_record($id)
    {
    	$record = Record::find($id);
    	return view('admin.edit_record')->with('record',$record);
    }
}
