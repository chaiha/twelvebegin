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
        return view('sale.select.select_call_record')->with('record',$record)->with('call_amount',$call_amount)->with('select_record',$select_record);
    }

    public function preview_filled_record(Request $request)
    {
        $result = $request->input('call_result');
        $is_tel_correct = $request->input('is_tel_correct');
        if($is_tel_correct=="0")
        {
            $new_tel = $request->input('new_tel');
        }
        else
        {
            $new_tel = "";
        }

        if($result=="yes")
        {
            $feedback = $request->input('feedback');
            $start_priviledge_day = $request->input('start_priviledge_day');
            $start_priviledge_month = $request->input('start_priviledge_month');
            $start_priviledge_year = $request->input('start_priviledge_year');
            $end_priviledge_day = $request->input('end_priviledge_day');
            $end_priviledge_month = $request->input('end_priviledge_month');
            $end_priviledge_year = $request->input('end_priviledge_year');

        }
        else if($result=="no_reply")
        {
            $cannot_contact_amount_call = $request->input('cannot_contact_amount_call');
            $cannot_contact_reason = $request->input('cannot_contact_reason');
            $cannot_contact_appointment_day = $request->input('cannot_contact_appointment_day');
            $cannot_contact_appointment_month = $request->input('cannot_contact_appointment_month');
            $cannot_contact_appointment_year = $request->input('cannot_contact_appointment_year');
        }
        else if($result=="rejected")
        {
            $no_reason = $request->input('no_reason');
            $no_note = $request->input('no_note');
        }
        else if($result=="waiting")
        {
            $consider_reason = $request->input('consider_reason');
            $consider_appointment_feedback_day = $request->input('consider_appointment_feedback_day');
            $consider_appointment_feedback_month = $request->input('consider_appointment_feedback_month');
            $consider_appointment_feedback_year = $request->input('consider_appointment_feedback_year');
        }
        else if($result=="closed")
        {
            $closed = $request->input('closed');
        }
        // $record = array();
        // $latest_no = Record::latest('id')->first();
        // $record['no']= $latest_no->no;
        // $record['code'] = $request->input('code');
        // $record['status'] = $request->input('status');
        // // $effective_date = $request->input('effective_date');
        // $record['sources'] = $request->input('sources');
        // $record['categories'] = $request->input('categories');
        // $record['dtac_type'] = $request->input('dtac_type');
        // $record['input_date'] = date("Y-m-d");
        // //$distributed_date = $request->input('distributed_date');
        // //$deadline = $request->input('deadline');
        // $record['sale'] = $request->input('sale');
        // $record['name_th'] = $request->input('name_th');
        // $record['name_en'] = $request->input('name_en');
        // $record['branch'] = $request->input('branch');
        // $record['address'] = $request->input('address');
        // $record['contact_tel'] = $request->input('contact_tel');
        // $record['latitude'] = $request->input('latitude');
        // $record['longitude'] = $request->input('longitude');
        // $record['shop_type'] = $request->input('shop_type');
        // $record['contact_person'] = $request->input('contact_person');
        // $record['contact_email'] = $request->input('contact_email');
        // $record['contact_day'] = $request->input('contact_day');
        // $record['contact_month'] = $request->input('contact_month');
        // $record['contact_year'] = $request->input('contact_year');
        // $record['province'] = $request->input('province');
        // $record['links'] = $request->input('links');
        // $record['remarks'] = $request->input('remarks');

        // session(['new_record' => $record]);

        // return redirect('/admin/record/preview_new_record');
    }
}

?>