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
use App\YesRecords;

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
        $selected_record_extend = SelectRecord::where('sale_id','=',$user->id)->where('selective_status','=','extend')->get();
        $selected_record_waiting = SelectRecord::where('sale_id','=',$user->id)->where('selective_status','=','waiting')->get();
        $selected_record_noreply = SelectRecord::where('sale_id','=',$user->id)->where('selective_status','=','noreply')->get();
        $selected_record_new = SelectRecord::where('sale_id','=',$user->id)->where('selective_status','=','new')->get();
        $record_list_extend = array();
        $record_list_waiting = array();
        $record_list_noreply = array();
        $record_list_new = array();
        //print_r($selected_record);
        // $n=0;
        // foreach ($selected_record_extend as $selected_record_each)
        // {
        //     $record_list_extend[$n]=$selected_record_each->record_id;
        //     $n++;
        // }
        // $n=0;
        // foreach ($selected_record_waiting as $selected_record_each)
        // {
        //     $record_list_waiting[$n]=$selected_record_each->record_id;
        //     $n++;
        // }
        // $n=0;
        // foreach ($selected_record_noreply as $selected_record_each)
        // {
        //     $record_list_noreply[$n]=$selected_record_each->record_id;
        //     $n++;
        // }
        // $n=0;
        // foreach ($selected_record_new as $selected_record_each)
        // {
        //     $record_list_new[$n]=$selected_record_each->record_id;
        //     $n++;
        // }

        // $result_extend = DB::table('records')->whereIn('id', $record_list_extend)->get();
        // $result_waiting = DB::table('records')->whereIn('id', $record_list_waiting)->get();
        // $result_noreply = DB::table('records')->whereIn('id', $record_list_noreply)->get();
        // $result_new = DB::table('records')->whereIn('id', $record_list_new)->get();
        //print_r($record_list);
        return view('sale.select.show_select_list')->with('sale',$user)->with('record_list_extend',$selected_record_extend)->with('record_list_waiting',$selected_record_waiting)->with('record_list_noreply',$selected_record_noreply)->with('record_list_new',$selected_record_new);

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
        $sale_filled = array();
        $sale_filled['call_result'] = $request->input('call_result');
        $call_result = $request->input('call_result');
        $sale_filled['is_tel_correct'] = $request->input('is_tel_correct');
        $is_tel_correct = $request->input('is_tel_correct');
        $sale_filled['record_id'] = $request->input('record_id');
        $record_id = $request->input('record_id');

        $edit_address = $request->input('edit_address');
        $edit_contact_person = $request->input('edit_contact_person');
        if($edit_address!="")
        {
            //มีการแก้ไข address
            $sale_filled['edit_address'] = $edit_address;
            
        }
        else
        {
            $sale_filled['edit_address'] ="none";
        }
        if($edit_contact_person!="")
        {
            //มีการแก้ไข contact_person
            $sale_filled['edit_contact_person'] = $edit_contact_person;
            
        }
        else
        {
            $sale_filled['edit_contact_person']="none";
        }
        // print_r($sale_filled['edit_address']);
        // echo "<br />";
        // print_r($sale_filled['edit_contact_person']);
        if($is_tel_correct=="0")
        {
            $sale_filled['new_tel'] = $request->input('new_tel');
        }
        else
        {
            $sale_filled['new_tel'] = "";
        }

        if($call_result=="yes")
        {
            $sale_filled['feedback'] = $request->input('feedback');
            $sale_filled['condition'] = $request->input('condition');
            $sale_filled['start_priviledge_day'] = $request->input('start_priviledge_day');
            $sale_filled['start_priviledge_month'] = $request->input('start_priviledge_month');
            $sale_filled['start_priviledge_year'] = $request->input('start_priviledge_year');
            $sale_filled['end_priviledge_day'] = $request->input('end_priviledge_day');
            $sale_filled['end_priviledge_month'] = $request->input('end_priviledge_month');
            $sale_filled['end_priviledge_year'] = $request->input('end_priviledge_year');

        }
        else if($call_result=="no_reply")
        {
            $sale_filled['cannot_contact_amount_call'] = $request->input('cannot_contact_amount_call');
            $sale_filled['cannot_contact_reason'] = $request->input('cannot_contact_reason');
            $sale_filled['cannot_contact_appointment_day'] = $request->input('cannot_contact_appointment_day');
            $sale_filled['cannot_contact_appointment_month'] = $request->input('cannot_contact_appointment_month');
            $sale_filled['cannot_contact_appointment_year'] = $request->input('cannot_contact_appointment_year');
        }
        else if($call_result=="rejected")
        {
            $sale_filled['no_reason'] = $request->input('no_reason');
            $sale_filled['no_note'] = $request->input('no_note');
        }
        else if($call_result=="waiting")
        {
            $sale_filled['consider_reason'] = $request->input('consider_reason');
            $sale_filled['consider_appointment_feedback_day'] = $request->input('consider_appointment_feedback_day');
            $sale_filled['consider_appointment_feedback_month'] = $request->input('consider_appointment_feedback_month');
            $sale_filled['consider_appointment_feedback_year'] = $request->input('consider_appointment_feedback_year');
        }
        else if($call_result=="closed")
        {
            $sale_filled['closed'] = "1";
        }

        session(['sale_filled' => $sale_filled]);
        
        return redirect('/sale/select_record/show_preview_filled_record');
    }

    public function show_preview_filled_record()
    {
        $user = session('user');
        $sale_filled = session('sale_filled');
        $record_id = $sale_filled['record_id'];
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$user->id)->first();
        $is_tel_correct = $sale_filled['is_tel_correct'];
        $edit_address = $sale_filled['edit_address'];
        $edit_contact_person = $sale_filled['edit_contact_person'];
        $call_result = $sale_filled['call_result'];

        return view('sale.select.show_preview_filled_record')->with('sale_filled',$sale_filled)->with('select_record',$select_record)->with('is_tel_correct',$is_tel_correct)->with('edit_address',$edit_address)->with('edit_contact_person',$edit_contact_person)->with('call_result',$call_result);
    }

    public function submit_filled_record()//16032560
    {
        //Submit all data to select_record
        $user = session('user');
        $sale_filled = session('sale_filled');
        //$record = Record::where('id','=',$sale_filled['record_id'])->first();
        $select_record = SelectRecord::where('id','=',$sale_filled['record_id'])->first();

        $select_record->result = $sale_filled['call_result'];
        $select_record->result_date = date("Y-m-d");

        if($sale_filled['edit_address']!="")
        {
            $select_record->edit_address = $sale_filled['edit_address'];
        }

        if($sale_filled['edit_contact_person']!="")
        {
            $select_record->edit_contact_person = $sale_filled['edit_contact_person'];
        }

        if($sale_filled['call_result']=="yes")
        {
            $select_record->yes_sale_name = $user->first_name;
            $select_record->yes_privilege_start = $sale_filled['start_priviledge_year']."-".$sale_filled['start_priviledge_month']."-".$sale_filled['start_priviledge_day'];
            $select_record->yes_privilege_end = $sale_filled['end_priviledge_year']."-".$sale_filled['end_priviledge_month']."-".$sale_filled['end_priviledge_day'];
            $select_record->yes_feedback = $sale_filled['feedback'];
            $select_record->yes_condition = $sale_filled['condition'];

            $select_record->status="Not_Available";
        }
        else if($sale_filled['call_result']=="no_reply")
        {
            $select_record->cannot_contact_amount_call = $sale_filled['cannot_contact_amount_call'];
            $select_record->cannot_contact_reason = $sale_filled['cannot_contact_reason'];
            $select_record->cannot_contact_appointment = $sale_filled['cannot_contact_appointment_year']."-".$sale_filled['cannot_contact_appointment_month']."-".$sale_filled['cannot_contact_appointment_day'];
        }
        else if($sale_filled['call_result']=="rejected")
        {
            $select_record->no_reason = $sale_filled['no_reason'];
            $select_record->no_note = $sale_filled['no_note'];
            $select_record->status="Not_Available";
        }
        else if($sale_filled['call_result']=="waiting")
        {
            $select_record->consider_reason = $sale_filled['consider_reason'];
            $select_record->consider_appointment_feedback = $sale_filled['consider_appointment_feedback_year']."-".$sale_filled['consider_appointment_feedback_month']."-".$sale_filled['consider_appointment_feedback_day'];
        }
        else if($sale_filled['call_result']=="closed")
        {
            $select_record->close = "1";
            $select_record->status="Not_Available";
        }

        if($sale_filled['is_tel_correct']=="0")
        {
            $select_record->is_tel_correct = "0";
            $select_record->wrong_number_new_tel_number = $sale_filled['new_tel'];
        }
        else
        {
            $select_record->is_tel_correct = "0";
            $select_record->wrong_number_new_tel_number = "";
        }
        
        $select_record->updated_by = $user->id;
        $select_record->updated_at = date("Y-m-d H:i:s");
        
        $select_record->call_status ="called";

        // print_r($select_record);
        $select_record->save();

        if($sale_filled['call_result']=="yes")
        {

            $yes_records = new YesRecords;
            $yes_records->record_id = $sale_filled['record_id']; 
            $yes_records->sale_id = $user->id;
            $yes_records->result = $sale_filled['call_result']; 
            $yes_records->result_date = date("Y-m-d");
            $yes_records->yes_sale_name = $user->first_name;
            $yes_records->yes_privilege_start = $sale_filled['start_priviledge_year']."-".$sale_filled['start_priviledge_month']."-".$sale_filled['start_priviledge_day'];
            $yes_records->yes_privilege_end = $sale_filled['end_priviledge_year']."-".$sale_filled['end_priviledge_month']."-".$sale_filled['end_priviledge_day'];
            $yes_records->yes_feedback = $sale_filled['feedback'];
            $yes_records->yes_condition = $sale_filled['condition'];
            $yes_records->updated_at = date("Y-m-d");
            $yes_records->updated_by = $user->id;
            $yes_records->save();

        }

        return redirect('/sale/select_record/call/success/'.$sale_filled['record_id']);

    }

    public function edit_filled_record(Request $request)
    {
        $user = session('user');
        $sale_filled = session('sale_filled');
        $select_record = SelectRecord::where('record_id','=',$sale_filled['record_id'])->where('sale_id','=',$user->id)->first();
        session(['select_record' => $select_record]);
        

        return redirect('/sale/select_record/show_edit_preview_filled_record');
    }

    public function show_edit_filled_record()
    {
        $user = session('user');
        $sale_filled = session('sale_filled');
        $select_record = session('select_record');
        return view('sale.select.edit_call_record')->with('user',$user)->with('select_record',$select_record)->with('sale_filled',$sale_filled);
    }

    public function submit_edit_call_record(Request $request)
    {
        $sale_filled_old = session('sale_filled');
        $sale_filled_new = array();
        $sale_filled_new['call_result'] = $request->input('call_result');
        $call_result = $request->input('call_result');
        $sale_filled_new['is_tel_correct'] = $request->input('is_tel_correct');
        $is_tel_correct = $request->input('is_tel_correct');
        $sale_filled_new['record_id'] = $request->input('record_id');
        $record_id = $request->input('record_id');

        $edit_address = $request->input('edit_address');
        $edit_contact_person = $request->input('edit_contact_person');
        if($edit_address!="")
        {
            //มีการแก้ไข address
            $sale_filled_new['edit_address'] = $edit_address;
            
        }
        else
        {
            $sale_filled_new['edit_address'] = $sale_filled_old['edit_address'];
        }
        
        if($edit_contact_person!="")
        {
            //มีการแก้ไข contact_person
            $sale_filled_new['edit_contact_person'] = $edit_contact_person;
            
        }
        else
        {
            $sale_filled_new['edit_contact_person'] = $sale_filled_old['edit_contact_person'];
        }

        if($is_tel_correct=="0")
        {
            $sale_filled_new['new_tel'] = $request->input('new_tel');
        }
        else
        {
            $new_tel = "";
        }

        if($call_result=="yes")
        {
            $sale_filled_new['feedback'] = $request->input('feedback');
            $sale_filled_new['condition'] = $request->input('condition');
            $sale_filled_new['start_priviledge_day'] = $request->input('start_priviledge_day');
            $sale_filled_new['start_priviledge_month'] = $request->input('start_priviledge_month');
            $sale_filled_new['start_priviledge_year'] = $request->input('start_priviledge_year');
            $sale_filled_new['end_priviledge_day'] = $request->input('end_priviledge_day');
            $sale_filled_new['end_priviledge_month'] = $request->input('end_priviledge_month');
            $sale_filled_new['end_priviledge_year'] = $request->input('end_priviledge_year');

        }
        else if($call_result=="no_reply")
        {
            $sale_filled_new['cannot_contact_amount_call'] = $request->input('cannot_contact_amount_call');
            $sale_filled_new['cannot_contact_reason'] = $request->input('cannot_contact_reason');
            $sale_filled_new['cannot_contact_appointment_day'] = $request->input('cannot_contact_appointment_day');
            $sale_filled_new['cannot_contact_appointment_month'] = $request->input('cannot_contact_appointment_month');
            $sale_filled_new['cannot_contact_appointment_year'] = $request->input('cannot_contact_appointment_year');
        }
        else if($call_result=="rejected")
        {
            $sale_filled_new['no_reason'] = $request->input('no_reason');
            $sale_filled_new['no_note'] = $request->input('no_note');
        }
        else if($call_result=="waiting")
        {
            $sale_filled_new['consider_reason'] = $request->input('consider_reason');
            $sale_filled_new['consider_appointment_feedback_day'] = $request->input('consider_appointment_feedback_day');
            $sale_filled_new['consider_appointment_feedback_month'] = $request->input('consider_appointment_feedback_month');
            $sale_filled_new['consider_appointment_feedback_year'] = $request->input('consider_appointment_feedback_year');
        }
        else if($call_result=="closed")
        {
            $sale_filled_new['closed'] = "1";
        }

        print_r($sale_filled_new);

        //session(['sale_filled' => $sale_filled_new]);
        
        //return redirect('/sale/select_record/show_preview_filled_record');
    }

    public function call_success($id)
    {   
        $user = session('user');
        $select_record = SelectRecord::where('id','=',$id)->where('sale_id','=',$user->id)->first();
        return view('sale.select.success_call_record')->with('select_record',$select_record);
    }

    public function submit_allresult_selected_record(Request $request)
    {
        $sale_id = $request->input('sale_id');
        $sale_selected_record = SelectRecord::where('sale_id','=',$sale_id)->get();
        // foreach ($sale_selected_record as $sale_selected_record_each ) {
        //     if($sale_selected_record_each->)
        // }
    }
}

?>