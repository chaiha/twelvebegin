<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Session;
use User;	
use App\Record;
use App\SelectRecord;

class CallController extends Controller
{
    public function index()
    {
        $user = session('user');
        return view('sale.index')->with('user',$user);
    }
    public function show_list_record()
    {
        $user = session('user');
        $selected_record = SelectRecord::where('sale_id','=',$user->id)->get();
        $record_list = array();
        $n=0;
        foreach ($selected_record as $selected_record_each)
        {
            $record_list[$n]=$selected_record_each->id;
            $n++;
        }
        $result = DB::table('records')->whereIn('id', $record_list)->get();
        
        return view('sale.select.show_select_list')->with('sale',$user)->with('record_list',$result);

    }
}

?>