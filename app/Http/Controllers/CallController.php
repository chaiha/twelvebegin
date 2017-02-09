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
        $result = DB::table('records')->whereIn('id', $record_list)->paginate(100);
        
        return view('sale.select.show_select_list')->with('sale',$user)->with('record_list',$result);

    }

    public function select_record_call($id)
    {
        $record = Record::increase_call_amount($id);
        $record = Record::where('id','=',$id)->first();
        $user = session('user');
        $select_record = SelectRecord::where('record_id','=',$id)->where('sale_id','=',$user->id)->first();
        $call_amount = $select_record->call_amount;
        return view('sale.select.select_call_record')->with('record',$record)->with('call_amount',$call_amount);
    }

    public function preview_filled_record()
    {
        return "ok";
    }
}

?>