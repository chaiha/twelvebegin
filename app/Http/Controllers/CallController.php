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
use App\YesRecords;
use App\SaleRecordYesCollection;

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

        $SelectRecord = new SelectRecord;
        $has_sending_status_null = $SelectRecord->has_sending_status_null($user->id);
        $has_is_corrected_result = $SelectRecord->has_is_corrected_result($user->id);
        $has_status_sent = $SelectRecord->has_status_sent($user->id);
        $check_cannot_send = $SelectRecord->check_cannot_send($user->id);

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
        // print_r($has_sending_status_null);
        return view('sale.select.show_select_list')->with('sale',$user)->with('record_list_extend',$selected_record_extend)->with('record_list_waiting',$selected_record_waiting)->with('record_list_noreply',$selected_record_noreply)->with('record_list_new',$selected_record_new)->with('has_sending_status_null',$has_sending_status_null)->with('has_is_corrected_result',$has_is_corrected_result)->with('has_status_sent',$has_status_sent)->with('check_cannot_send',$check_cannot_send);

    }

    public function select_record_call($id)
    {
        $user = session('user');
        $record = SelectRecord::increase_call_amount($id);
        $record = SelectRecord::where('record_id','=',$id)->first();
        $select_record = SelectRecord::where('record_id','=',$id)->where('sale_id','=',$user->id)->first();
        // print_r($user);
        $call_amount = $select_record->call_amount;
        return view('sale.select.select_call_record')->with('record',$record)->with('call_amount',$call_amount)->with('select_record',$select_record);
    }

    public function preview_filled_record(Request $request)
    {
        $sale_filled = array();
        $sale_filled['call_result'] = $request->input('call_result');
        $call_result = $request->input('call_result');
        $sale_filled['is_tel_correct'] = '1';
        $is_tel_correct = '1';
        $sale_filled['record_id'] = $request->input('record_id');
        $sale_filled['sending_address'] = $request->input('sending_address');
        $record_id = $request->input('record_id');

        $sale_filled['branch_amount'] = $request->input('branch_amount');
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
            $sale_filled['start_priviledge_date'] = $request->input('start_priviledge_date');
            $sale_filled['end_priviledge_date'] = $request->input('end_priviledge_date');
            $sale_filled['has_reply_doc'] = $request->input('has_reply_doc');
            $sale_filled['has_confirm_product_img'] = $request->input('has_confirm_product_img');
            $sale_filled['has_confirm_logo_img'] = $request->input('has_confirm_logo_img');
            $sale_filled['has_shop_img'] = $request->input('has_shop_img');
            $sale_filled['has_product_img'] = $request->input('has_product_img');
            $sale_filled['has_logo_img'] = $request->input('has_logo_img');

        }
        else if($call_result=="no_reply")
        {
            $sale_filled['cannot_contact_reason'] = $request->input('cannot_contact_reason');
            $sale_filled['cannot_contact_appointment_date'] = $request->input('cannot_contact_appointment_date');
        }
        else if($call_result=="rejected")
        {
            $sale_filled['no_reason'] = $request->input('no_reason');
        }
        else if($call_result=="waiting")
        {
            $sale_filled['consider_reason'] = $request->input('consider_reason');
            $sale_filled['consider_appointment_feedback_date'] = $request->input('consider_appointment_feedback_date');
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
        $is_tel_correct = '1';
        $edit_address = $sale_filled['edit_address'];
        $sending_address =$sale_filled['sending_address'];
        $edit_contact_person = $sale_filled['edit_contact_person'];
        $call_result = $sale_filled['call_result'];

        return view('sale.select.show_preview_filled_record')->with('sale_filled',$sale_filled)->with('select_record',$select_record)->with('is_tel_correct',$is_tel_correct)->with('sending_address',$sending_address)->with('edit_address',$edit_address)->with('edit_contact_person',$edit_contact_person)->with('call_result',$call_result);
    }

    public function submit_filled_record()//16032560
    {
        //Submit all data to select_record
        $user = session('user');
        $sale_filled = session('sale_filled');
        $submit_record_id = $sale_filled['record_id'];
        //$record = Record::where('id','=',$sale_filled['record_id'])->first();
        $select_record = SelectRecord::where('record_id','=',$sale_filled['record_id'])->first();

        $select_record->result = $sale_filled['call_result'];
        $select_record->result_date = date("Y-m-d");

        $select_record->branch_amount = $sale_filled['branch_amount'];
        $select_record->sending_address = $sale_filled['sending_address'];

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
            $new_yes_privilege_start = explode('/', $sale_filled['start_priviledge_date']);
            $new_yes_privilege_end = explode('/', $sale_filled['end_priviledge_date']);
            $select_record->yes_privilege_start = $new_yes_privilege_start[2]."-".$new_yes_privilege_start[1]."-".$new_yes_privilege_start[0];
            $select_record->yes_privilege_end = $new_yes_privilege_end[2]."-".$new_yes_privilege_end[1]."-".$new_yes_privilege_end[0];
            $select_record->yes_feedback = $sale_filled['feedback'];
            $select_record->yes_condition = $sale_filled['condition'];
            $select_record->has_reply_doc = $sale_filled['has_reply_doc'];
            $select_record->has_confirm_product_img = $sale_filled['has_confirm_product_img'];
            $select_record->has_confirm_logo_img = $sale_filled['has_confirm_logo_img'];
            $select_record->has_shop_img = $sale_filled['has_shop_img'];
            $select_record->has_product_img = $sale_filled['has_product_img'];
            $select_record->has_logo_img = $sale_filled['has_logo_img'];

            $select_record->status="Not_Available";
        }
        else if($sale_filled['call_result']=="no_reply")
        {
            $select_record->cannot_contact_reason = $sale_filled['cannot_contact_reason'];
            $new_cannot_contact_appointment = explode('/', $sale_filled['cannot_contact_appointment_date']);
            $select_record->cannot_contact_appointment = $new_cannot_contact_appointment[2]."-".$new_cannot_contact_appointment[1]."-".$new_cannot_contact_appointment[0];
        }
        else if($sale_filled['call_result']=="rejected")
        {
            $select_record->no_reason = $sale_filled['no_reason'];
            $select_record->status="Not_Available";
        }
        else if($sale_filled['call_result']=="waiting")
        {
            $select_record->consider_reason = $sale_filled['consider_reason'];
            $new_consider_appointment_feedback = explode('/', $sale_filled['consider_appointment_feedback_date']);
            $select_record->consider_appointment_feedback = $new_consider_appointment_feedback[2]."-".$new_consider_appointment_feedback[1]."-".$new_consider_appointment_feedback[0];
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
            $select_record->is_tel_correct = "1";
            $select_record->wrong_number_new_tel_number = "";
        }
        
        $select_record->updated_by = $user->id;
        $select_record->updated_at = date("Y-m-d H:i:s");
        
        $select_record->call_status ="called";

        // print_r($select_record);
        $select_record->save();

        

        if($sale_filled['call_result']=="yes")
        {
            //redirect to edit_record_info
            Session::forget('sale_filled');
            return redirect('/sale/edit_record/record/show/'.$submit_record_id);

        }
        else
        {
            //redirect to success page
            Session::forget('sale_filled');
            return redirect('/sale/select_record/call/success/'.$submit_record_id);
        }
        

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
        $sale_filled_new['is_tel_correct'] = '1';
        $is_tel_correct = '1';
        $sale_filled_new['record_id'] = $request->input('record_id');
        $record_id = $request->input('record_id');

        $sale_filled_new['branch_amount'] = $request->input('branch_amount');
        $sale_filled_new['sending_address'] = $request->input('sending_address');

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
            $sale_filled_new['start_priviledge_date'] = $request->input('start_priviledge_date');
            $sale_filled_new['end_priviledge_date'] = $request->input('end_priviledge_date');
            $sale_filled_new['has_reply_doc'] = $request->input('has_reply_doc');
            $sale_filled_new['has_confirm_product_img'] = $request->input('has_confirm_product_img');
            $sale_filled_new['has_confirm_logo_img'] = $request->input('has_confirm_logo_img');
            $sale_filled_new['has_shop_img'] = $request->input('has_shop_img');
            $sale_filled_new['has_product_img'] = $request->input('has_product_img');
            $sale_filled_new['has_logo_img'] = $request->input('has_logo_img');

        }
        else if($call_result=="no_reply")
        {
            $sale_filled_new['cannot_contact_reason'] = $request->input('cannot_contact_reason');
            $sale_filled_new['cannot_contact_appointment_date'] = $request->input('cannot_contact_appointment_date');
        }
        else if($call_result=="rejected")
        {
            $sale_filled_new['no_reason'] = $request->input('no_reason');
            $sale_filled_new['no_note'] = $request->input('no_note');
        }
        else if($call_result=="waiting")
        {
            $sale_filled_new['consider_reason'] = $request->input('consider_reason');
            $sale_filled_new['consider_appointment_feedback_date'] = $request->input('consider_appointment_feedback_date');
        }
        else if($call_result=="closed")
        {
            $sale_filled_new['closed'] = "1";
        }

        //print_r($sale_filled_new);

        session(['sale_filled' => $sale_filled_new]);
        
        return redirect('/sale/select_record/show_preview_filled_record');
        //return redirect('/sale/select_record/show_preview_filled_submit_record');
    }

    public function call_success($id)
    {   
        $user = session('user');
        $select_record = SelectRecord::where('record_id','=',$id)->where('sale_id','=',$user->id)->first();
        return view('sale.select.success_call_record')->with('select_record',$select_record);
    }

    public function submit_allresult_selected_record(Request $request)
    {
        /*
            1.get the records by sale_id in select_records
            [this should be in the step after admin approve]
                2.update result by using record_id in records.
                2.1 if the result is "yes" copy record to yes_record table.
                3.remove records in select_record.
            4.redirect back to show_selected_record_list.
        */
        $user = session('user');
        $sale_id = $request->input('sale_id');
        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        //Update all records of this sale_id = sending_status = 'sent' AND can_approve = $tomorrow
        SelectRecord::where('sale_id','=',$sale_id)->update(['sending_status'=>'sent','can_approve'=>$tomorrow,'cannot_send'=>'1']);

        return redirect('/sale/show_selected_record_list');

        // foreach ($sale_selected_record as $sale_selected_record_each ) 
        // {

        //2.update result by using record_id in records.
            // $updated_record = Record::where('id','=',$sale_selected_record_each->record_id)->first();
            // if($sale_selected_record_each->result=="")
            // {
            //     $updated_record->status = "Available";
            // }
            // else
            // {
            //     $updated_record->status = "Not_Available";
            // }
            // $updated_record->sale = $user->id;
            // if($sale_selected_record_each->edit_address!="none")
            // {
            //     $updated_record->address = $sale_selected_record_each->edit_address;
            // }
            // if($sale_selected_record_each->edit_contact_person!="none")
            // {
            //     $updated_record->contact_person = $sale_selected_record_each->edit_contact_person;
            // }
            // $updated_record->result = $sale_selected_record_each->result;
            // $updated_record->result_date = $sale_selected_record_each->result_date;
            // $updated_record->yes_sale_name = $sale_selected_record_each->yes_sale_name;
            // $updated_record->yes_privilege_start = $sale_selected_record_each->yes_privilege_start;
            // $updated_record->yes_privilege_end = $sale_selected_record_each->yes_privilege_end;
            // $updated_record->yes_feedback = $sale_selected_record_each->yes_feedback;
            // $updated_record->yes_condition = $sale_selected_record_each->yes_condition;
            // $updated_record->no_reason = $sale_selected_record_each->no_reason;
            // $updated_record->no_note = $sale_selected_record_each->no_note;
            // $updated_record->cannot_contact_amount_call = $sale_selected_record_each->cannot_contact_amount_call;
            // $updated_record->cannot_contact_reason = $sale_selected_record_each->cannot_contact_reason;
            // $updated_record->cannot_contact_appointment = $sale_selected_record_each->cannot_contact_appointment;
            // $updated_record->cannot_contact_times = $updated_record->cannot_contact_times+1;
            // $updated_record->consider_reason = $sale_selected_record_each->consider_reason;
            // $updated_record->consider_appointment_feedback = $sale_selected_record_each->consider_appointment_feedback;
            // $updated_record->is_tel_correct = $sale_selected_record_each->is_tel_correct;
            // $updated_record->wrong_number_new_tel_number = $sale_selected_record_each->wrong_number_new_tel_number;
            // $updated_record->close = $sale_selected_record_each->close;
            // $updated_record->result_remark = $sale_selected_record_each->result_remark;
            // $updated_record->updated_by = $sale_selected_record_each->updated_by;
            // $updated_record->updated_at = $sale_selected_record_each->updated_at;

            // // echo "<h1>updated_record</h1>";
            // // print_r($updated_record);
            // // echo "<br /><br /><br /><br />";
            // $updated_record->save();

            //2.1copy result to yes_record table
            // if($sale_selected_record_each->result=="yes")
            // {

            //     $yes_records = new YesRecords;
            //     $yes_records->record_id = $sale_selected_record_each->record_id; 
            //     $yes_records->sale_id = $user->id;
            //     $yes_records->result = $sale_selected_record_each->result; 
            //     $yes_records->result_date = date("Y-m-d");
            //     $yes_records->yes_sale_name = $user->first_name;
            //     $yes_records->yes_privilege_start = $sale_selected_record_each->yes_privilege_start;
            //     $yes_records->yes_privilege_end = $sale_selected_record_each->yes_privilege_end;
            //     $yes_records->yes_feedback = $sale_selected_record_each->yes_feedback;
            //     $yes_records->yes_condition = $sale_selected_record_each->yes_condition;
            //     $yes_records->created_at = date("Y-m-d");
            //     $yes_records->created_by = $user->id;
            //     $yes_records->updated_at = date("Y-m-d");
            //     $yes_records->updated_by = $user->id;
            //     $yes_records->save();

                // echo "<h1>yes_records</h1>";
                // print_r($yes_records);
                // echo "<br /><br /><br /><br />";

            // }

            //3.remove select_record from select_record table
            //$delete_select_record = SelectRecord::where('record_id','=',$sale_selected_record_each->record_id)->first();
            //$delete_select_record->delete();

            //3.1 update call_status to be "called"
       //      $called_select_record = SelectRecord::where('record_id','=',$sale_selected_record_each->record_id)->first();
       //      $called_select_record->call_status = "called";
       //      $called_select_record->save();
       //  }

       //  //4.redirect to show_selected_record_list.
       // return redirect('/sale/show_selected_record_list');

    }

    public function edit_submit_record($record_id)
    {
        $sale_filled_edit = session('sale_filled_edit');
        //print_r($sale_filled_edit);
        $select_record = SelectRecord::where('record_id','=',$record_id)->first();
        $user = session('user');
        return view('sale.select.edit_submit_record')->with('select_record',$select_record)->with('user',$user)->with('sale_filled_edit',$sale_filled_edit);
    }

    public function preview_edit_submit_record(Request $request)
    {
        
        $sale_filled_edit = array();
        $sale_filled_edit['call_result'] = $request->input('call_result');
        $call_result = $request->input('call_result');
        $sale_filled_edit['is_tel_correct'] = '1';
        $is_tel_correct = '1';
        $sale_filled_edit['record_id'] = $request->input('record_id');
        $record_id = $request->input('record_id');

        $sale_filled_edit['branch_amount'] = $request->input('branch_amount');
        $sale_filled_edit['sending_address'] = $request->input('sending_address');
        $edit_address = $request->input('edit_address');
        $edit_contact_person = $request->input('edit_contact_person');
        if($edit_address!="")
        {
            //มีการแก้ไข address
            $sale_filled_edit['edit_address'] = $edit_address;
            
        }
        else
        {
            $sale_filled_edit['edit_address'] ="";
        }
        if($edit_contact_person!="")
        {
            //มีการแก้ไข contact_person
            $sale_filled_edit['edit_contact_person'] = $edit_contact_person;
            
        }
        else
        {
            $sale_filled_edit['edit_contact_person']="";
        }
        // print_r($sale_filled_edit['edit_address']);
        // echo "<br />";
        // print_r($sale_filled_edit['edit_contact_person']);
        if($is_tel_correct=="0")
        {
            $sale_filled_edit['new_tel'] = $request->input('new_tel');
        }
        else
        {
            $sale_filled_edit['new_tel'] = "";
        }

        if($call_result=="yes")
        {
            $sale_filled_edit['feedback'] = $request->input('feedback');
            $sale_filled_edit['condition'] = $request->input('condition');
            $sale_filled_edit['start_priviledge_date'] = $request->input('start_priviledge_date');
            $sale_filled_edit['end_priviledge_date'] = $request->input('end_priviledge_date');
            $sale_filled_edit['has_reply_doc'] = $request->input('has_reply_doc');
            $sale_filled_edit['has_confirm_product_img'] = $request->input('has_confirm_product_img');
            $sale_filled_edit['has_confirm_logo_img'] = $request->input('has_confirm_logo_img');
            $sale_filled_edit['has_shop_img'] = $request->input('has_shop_img');
            $sale_filled_edit['has_product_img'] = $request->input('has_product_img');
            $sale_filled_edit['has_logo_img'] = $request->input('has_logo_img');
            $sale_filled_edit['cannot_contact_amount_call'] = "";
            $sale_filled_edit['cannot_contact_reason'] = "";
            $sale_filled_edit['cannot_contact_appointment_date'] = "";
            $sale_filled_edit['no_reason'] = "";
            $sale_filled_edit['no_note'] = "";
            $sale_filled_edit['consider_reason'] = "";
            $sale_filled_edit['consider_appointment_feedback_date'] = "";
            $sale_filled_edit['closed'] = "0";
        }
        else if($call_result=="no_reply")
        {
            $sale_filled_edit['feedback'] = "";
            $sale_filled_edit['condition'] = "";
            $sale_filled_edit['start_priviledge_date'] = "";
            $sale_filled_edit['end_priviledge_date'] = "";
            $sale_filled_edit['has_reply_doc'] = "";
            $sale_filled_edit['has_confirm_product_img'] = "";
            $sale_filled_edit['has_confirm_logo_img'] = "";
            $sale_filled_edit['has_shop_img'] = "";
            $sale_filled_edit['has_product_img'] = "";
            $sale_filled_edit['has_logo_img'] = "";
            $sale_filled_edit['cannot_contact_reason'] = $request->input('cannot_contact_reason');
            $sale_filled_edit['cannot_contact_appointment_date'] = $request->input('cannot_contact_appointment_date');
            $sale_filled_edit['no_reason'] = "";
            $sale_filled_edit['no_note'] = "";
            $sale_filled_edit['consider_reason'] = "";
            $sale_filled_edit['consider_appointment_feedback_date'] = "";
            $sale_filled_edit['closed'] = "0";
        }
        else if($call_result=="rejected")
        {
            $sale_filled_edit['feedback'] = "";
            $sale_filled_edit['condition'] = "";
            $sale_filled_edit['start_priviledge_date'] = "";
            $sale_filled_edit['end_priviledge_date'] = "";
            $sale_filled_edit['has_reply_doc'] = "";
            $sale_filled_edit['has_confirm_product_img'] = "";
            $sale_filled_edit['has_confirm_logo_img'] = "";
            $sale_filled_edit['has_shop_img'] = "";
            $sale_filled_edit['has_product_img'] = "";
            $sale_filled_edit['has_logo_img'] = "";
            $sale_filled_edit['cannot_contact_amount_call'] = "";
            $sale_filled_edit['cannot_contact_reason'] = "";
            $sale_filled_edit['cannot_contact_appointment_date'] = "";
            $sale_filled_edit['no_reason'] = $request->input('no_reason');
            $sale_filled_edit['no_note'] = $request->input('no_note');
            $sale_filled_edit['consider_reason'] = "";
            $sale_filled_edit['consider_appointment_feedback_date'] = "";
            $sale_filled_edit['closed'] = "0";
        }
        else if($call_result=="waiting")
        {
            $sale_filled_edit['feedback'] = "";
            $sale_filled_edit['condition'] = "";
            $sale_filled_edit['start_priviledge_date'] = "";
            $sale_filled_edit['end_priviledge_date'] = "";
            $sale_filled_edit['has_reply_doc'] = "";
            $sale_filled_edit['has_confirm_product_img'] = "";
            $sale_filled_edit['has_confirm_logo_img'] = "";
            $sale_filled_edit['has_shop_img'] = "";
            $sale_filled_edit['has_product_img'] = "";
            $sale_filled_edit['has_logo_img'] = "";
            $sale_filled_edit['cannot_contact_amount_call'] = "";
            $sale_filled_edit['cannot_contact_reason'] = "";
            $sale_filled_edit['cannot_contact_appointment_date'] = "";
            $sale_filled_edit['no_reason'] = "";
            $sale_filled_edit['no_note'] = "";
            $sale_filled_edit['consider_reason'] = $request->input('consider_reason');
            $sale_filled_edit['consider_appointment_feedback_date'] = $request->input('consider_appointment_feedback_date');
            $sale_filled_edit['closed'] = "0";
        }
        else if($call_result=="closed")
        {
            $sale_filled_edit['feedback'] = "";
            $sale_filled_edit['condition'] = "";
            $sale_filled_edit['start_priviledge_date'] = "";
            $sale_filled_edit['end_priviledge_date'] = "";
            $sale_filled_edit['has_reply_doc'] = "";
            $sale_filled_edit['has_confirm_product_img'] = "";
            $sale_filled_edit['has_confirm_logo_img'] = "";
            $sale_filled_edit['has_shop_img'] = "";
            $sale_filled_edit['has_product_img'] = "";
            $sale_filled_edit['has_logo_img'] = "";
            $sale_filled_edit['cannot_contact_amount_call'] = "";
            $sale_filled_edit['cannot_contact_reason'] = "";
            $sale_filled_edit['cannot_contact_appointment_date'] = "";
            $sale_filled_edit['no_reason'] = "";
            $sale_filled_edit['no_note'] = "";
            $sale_filled_edit['consider_reason'] = "";
            $sale_filled_edit['consider_appointment_feedback_date'] = "";
            $sale_filled_edit['closed'] = "1";
        }

        session(['sale_filled_edit' => $sale_filled_edit]);
        
        //print_r($sale_filled_edit);

        return redirect('/sale/select_record/show_preview_edit_submit_record');
    }

    public function show_preview_edit_submit_record()
    {
        // $sale_filled = session('sale_filled');
        // print_r($sale_filled);
        
        $user = session('user');
        $sale_filled_edit = session('sale_filled_edit');
        $record_id = $sale_filled_edit['record_id'];
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$user->id)->first();
        $is_tel_correct = '1';
        $sending_address = $sale_filled_edit['sending_address'];
        $edit_address = $sale_filled_edit['edit_address'];
        $edit_contact_person = $sale_filled_edit['edit_contact_person'];
        $call_result = $sale_filled_edit['call_result'];

        return view('sale.select.show_preview_edit_submit_record')->with('sale_filled_edit',$sale_filled_edit)->with('select_record',$select_record)->with('is_tel_correct',$is_tel_correct)->with('edit_address',$edit_address)->with('edit_contact_person',$edit_contact_person)->with('call_result',$call_result);
    }

    public function submit_edit_submit_record(Request $request)
    {
        //Submit all data to select_record
        $user = session('user');
        $sale_filled_edit = session('sale_filled_edit');
        $edit_record_id = $sale_filled_edit['record_id'];
        //$record = Record::where('id','=',$sale_filled_edit['record_id'])->first();
        $select_record = SelectRecord::where('record_id','=',$sale_filled_edit['record_id'])->first();

        $select_record->result = $sale_filled_edit['call_result'];
        $select_record->result_date = date("Y-m-d");

        $select_record->branch_amount = $sale_filled_edit['branch_amount'];
        $select_record->sending_address = $sale_filled_edit['sending_address'];
        if($select_record->sending_status=="not_approve")
        {
            $select_record->is_corrected = "1";
        }

        if($sale_filled_edit['edit_address']!="")//มีการแก้ไข
        {
            $select_record->edit_address = $sale_filled_edit['edit_address'];
        }

        if($sale_filled_edit['edit_contact_person']!="")//มีการแก้ไข
        {
            $select_record->edit_contact_person = $sale_filled_edit['edit_contact_person'];
        }

        if($sale_filled_edit['call_result']=="yes")
        {
            $select_record->yes_sale_name = $user->first_name;
            $new_yes_privilege_start = explode('/', $sale_filled_edit['start_priviledge_date']);
            $new_yes_privilege_end = explode('/', $sale_filled_edit['end_priviledge_date']);
            $select_record->yes_privilege_start = $new_yes_privilege_start[2]."-".$new_yes_privilege_start[1]."-".$new_yes_privilege_start[0];
            $select_record->yes_privilege_end = $new_yes_privilege_end[2]."-".$new_yes_privilege_end[1]."-".$new_yes_privilege_end[0];
            $select_record->yes_feedback = $sale_filled_edit['feedback'];
            $select_record->yes_condition = $sale_filled_edit['condition'];
            $select_record->has_reply_doc = $sale_filled_edit['has_reply_doc'];
            $select_record->has_confirm_product_img = $sale_filled_edit['has_confirm_product_img'];
            $select_record->has_confirm_logo_img = $sale_filled_edit['has_confirm_logo_img'];
            $select_record->has_shop_img = $sale_filled_edit['has_shop_img'];
            $select_record->has_product_img = $sale_filled_edit['has_product_img'];
            $select_record->has_logo_img = $sale_filled_edit['has_logo_img'];

            $select_record->status="Not_Available";

            //Reset the rest
            $select_record->cannot_contact_amount_call = NULL;
            $select_record->cannot_contact_reason = NULL;
            $select_record->cannot_contact_appointment = NULL;
            $select_record->no_reason = NULL;
            $select_record->no_note = NULL;
            $select_record->consider_reason = NULL;
            $select_record->consider_appointment_feedback = NULL;
            $select_record->close = NULL;
        }
        else if($sale_filled_edit['call_result']=="no_reply")
        {
            $select_record->cannot_contact_reason = $sale_filled_edit['cannot_contact_reason'];
            $new_cannot_contact_appointment = explode('/', $sale_filled_edit['cannot_contact_appointment_date']);
            $select_record->cannot_contact_appointment = $new_cannot_contact_appointment[2]."-".$new_cannot_contact_appointment[1]."-".$new_cannot_contact_appointment[0];

            //Reset the rest
            $select_record->yes_sale_name = NULL;
            $select_record->yes_privilege_start = NULL;
            $select_record->yes_privilege_end = NULL;
            $select_record->yes_feedback =NULL;
            $select_record->yes_condition = NULL;
            $select_record->has_reply_doc = "";
            $select_record->has_confirm_product_img = "";
            $select_record->has_confirm_logo_img = "";
            $select_record->has_shop_img = "";
            $select_record->has_product_img = "";
            $select_record->has_logo_img = "";
            $select_record->no_reason = NULL;
            $select_record->no_note = NULL;
            $select_record->consider_reason = NULL;
            $select_record->consider_appointment_feedback = NULL;
            $select_record->close = NULL;
        }
        else if($sale_filled_edit['call_result']=="rejected")
        {
            $select_record->no_reason = $sale_filled_edit['no_reason'];
            $select_record->no_note = $sale_filled_edit['no_note'];
            $select_record->status="Not_Available";

            //Reset the rest
            $select_record->yes_sale_name = NULL;
            $select_record->yes_privilege_start = NULL;
            $select_record->yes_privilege_end = NULL;
            $select_record->yes_feedback =NULL;
            $select_record->yes_condition = NULL;
            $select_record->has_reply_doc = "";
            $select_record->has_confirm_product_img = "";
            $select_record->has_confirm_logo_img = "";
            $select_record->has_shop_img = "";
            $select_record->has_product_img = "";
            $select_record->has_logo_img = "";
            $select_record->cannot_contact_amount_call = NULL;
            $select_record->cannot_contact_reason = NULL;
            $select_record->cannot_contact_appointment = NULL;
            $select_record->consider_reason = NULL;
            $select_record->consider_appointment_feedback = NULL;
            $select_record->close = NULL;
        }
        else if($sale_filled_edit['call_result']=="waiting")
        {
            $select_record->consider_reason = $sale_filled_edit['consider_reason'];
            $new_consider_appointment_feedback = explode('/', $sale_filled_edit['consider_appointment_feedback_date']);
            $select_record->consider_appointment_feedback = $new_consider_appointment_feedback[2]."-".$new_consider_appointment_feedback[1]."-".$new_consider_appointment_feedback[0];

            //Reset the rest
            $select_record->yes_sale_name = NULL;
            $select_record->yes_privilege_start = NULL;
            $select_record->yes_privilege_end = NULL;
            $select_record->yes_feedback =NULL;
            $select_record->yes_condition = NULL;
            $select_record->has_reply_doc = "";
            $select_record->has_confirm_product_img = "";
            $select_record->has_confirm_logo_img = "";
            $select_record->has_shop_img = "";
            $select_record->has_product_img = "";
            $select_record->has_logo_img = "";
            $select_record->cannot_contact_amount_call = NULL;
            $select_record->cannot_contact_reason = NULL;
            $select_record->cannot_contact_appointment = NULL;
            $select_record->no_reason = NULL;
            $select_record->no_note = NULL;
            $select_record->close = NULL;
        }
        else if($sale_filled_edit['call_result']=="closed")
        {
            $select_record->close = "1";
            $select_record->status="Not_Available";

            //Reset the rest
            $select_record->yes_sale_name = NULL;
            $select_record->yes_privilege_start = NULL;
            $select_record->yes_privilege_end = NULL;
            $select_record->yes_feedback =NULL;
            $select_record->yes_condition = NULL;
            $select_record->has_reply_doc = "";
            $select_record->has_confirm_product_img = "";
            $select_record->has_confirm_logo_img = "";
            $select_record->has_shop_img = "";
            $select_record->has_product_img = "";
            $select_record->has_logo_img = "";
            $select_record->cannot_contact_amount_call = NULL;
            $select_record->cannot_contact_reason = NULL;
            $select_record->cannot_contact_appointment = NULL;
            $select_record->no_reason = NULL;
            $select_record->no_note = NULL;
        }


        if($sale_filled_edit['is_tel_correct']=="0")
        {
            $select_record->is_tel_correct = "0";
            $select_record->wrong_number_new_tel_number = $sale_filled_edit['new_tel'];
        }
        else
        {
            $select_record->is_tel_correct = "1";
            $select_record->wrong_number_new_tel_number = "";
        }
        
        $select_record->updated_by = $user->id;
        $select_record->updated_at = date("Y-m-d H:i:s");
        
        $select_record->call_status ="called";

        // print_r($select_record);
        $select_record->save();

         if($sale_filled_edit['call_result']=="yes")
        {
            //redirect to edit_record_info
            Session::forget('sale_filled_edit');
            return redirect('/sale/edit_record/record/show/'.$edit_record_id);
        }
        else
        {
            Session::forget('sale_filled_edit');
            return redirect('/sale/select_record/submit_ediit_submit_record/success/'.$edit_record_id);
        }
        
    }

    public function success_edit_submit_record($record_id)
    {
        $user = session('user');
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$user->id)->first();
        return view('sale.select.success_edit_submit_record')->with('select_record',$select_record);
    }

    public function cancel_edit_submit_record()
    {
        //delete session value;
        Session::forget('sale_filled_edit');
        return redirect('/sale/show_selected_record_list');
    }

    public function edit_record_info($record_id)
    {
        $user = session('user');
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$user->id)->first();

        return view('sale.select.edit_record_info')->with('select_record',$select_record);
    }

    public function preview_edit_record_info(Request $request)
    {
        $select_record = array();
        $latest_no = SelectRecord::latest('id')->first();
        // $effective_date = $request->input('effective_date');
        $select_record['categories'] = $request->input('categories');
        $select_record['shop_type'] = $request->input('shop_type');
        
        $select_record['name_th'] = $request->input('name_th');
        $select_record['name_en'] = $request->input('name_en');
        $select_record['branch'] = $request->input('branch');
        $select_record['branch_amount'] = $request->input('branch_amount');
        $select_record['address'] = $request->input('address');
        $select_record['sending_address'] = $request->input('sending_address');
        
        $select_record['latitude'] = $request->input('latitude');
        $select_record['longtitude'] = $request->input('longtitude');

        $select_record['contact_person'] = $request->input('contact_person');
        $select_record['contact_tel'] = $request->input('contact_tel');
        $select_record['contact_email'] = $request->input('contact_email');
        $select_record['province'] = $request->input('province');
        $select_record['links'] = $request->input('links');
        $select_record['remarks'] = $request->input('remarks');

        $select_record['record_id'] = $request->input('record_id');


        session(['select_record_info' => $select_record]);

        return redirect('/sale/edit_record/record/show_preview_edit_info');
    }

    public function show_preview_edit_info()
    {
        $preview_record = session('select_record_info');
        $select_record = SelectRecord::where('record_id',$preview_record['record_id'])->first();
        //print_r($select_record);
        return view('sale.select.show_preview_edit_info')->with('select_record',$preview_record)->with('select_record_info',$select_record);   
    }

    public function submit_edit_record_info(Request $request)
    {
        $user = session('user');
        $record_id = $request->input('record_id');
        $edit_record_info = session('select_record_info');
        $select_record = SelectRecord::where('record_id','=',$record_id)->first();

        if($select_record->sending_status=="not_approve")
        {
            $select_record->is_corrected = "1";
        }

        $select_record->categories = $edit_record_info['categories'];
        $select_record->shop_type = $edit_record_info['shop_type'];
        $select_record->name_th = $edit_record_info['name_th'];
        $select_record->name_en = $edit_record_info['name_en'];
        $select_record->branch = $edit_record_info['branch'];
        $select_record->branch_amount = $edit_record_info['branch_amount'];
        $select_record->address = $edit_record_info['address'];
        $select_record->sending_address = $edit_record_info['sending_address'];
        $select_record->latitude = $edit_record_info['latitude'];
        $select_record->longtitude = $edit_record_info['longtitude'];
        $select_record->contact_person = $edit_record_info['contact_person'];
        $select_record->contact_tel = $edit_record_info['contact_tel'];
        $select_record->contact_email = $edit_record_info['contact_email'];
        $select_record->province = $edit_record_info['province'];
        $select_record->links = $edit_record_info['links'];
        $select_record->remarks = $edit_record_info['remarks'];
        $select_record->updated_at = date('Y-m-d H:i:s');
        $select_record->updated_by = $user->id;
        $select_record->save();

        Session::forget('edit_record_info');
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$user->id)->first();
        return view('sale.select.success_edit_info')->with('select_record',$select_record);

    }

    public function edit_preview_info($record_id)
    {
        $edit_record = session('select_record_info');
        $select_record = SelectRecord::where('record_id',$record_id)->first();
        return view('sale.select.edit_preview_info')->with('select_record',$select_record)->with('edit_record',$edit_record); 
    }

    public function cancel_edit_info()
    {
        Session::forget('edit_record_info');
        return redirect('/sale/show_selected_record_list');
    }

    public function show_sale_perform()
    {
        $sale = Sentinel::check();
        return view('sale.show_sale_perform.show_sale_perform')->with('sale',$sale);
    }

    public function show_sale_perform_by_range(Request $request)
    {
        $sale_id = $request->input('sale_id');
        $sale = Sentinel::findUserById($sale_id);
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date_array = explode('/', $start_date);
        $new_start_date = $start_date_array[2]."-".$start_date_array[1]."-".$start_date_array[0];
        $end_date_array = explode('/', $end_date);
        $new_end_date = $end_date_array[2]."-".$end_date_array[1]."-".$end_date_array[0];

        //Query
        $result = SaleRecordYesCollection::where('sale_id','=',$sale_id)->whereBetween('approve_date', [$new_start_date, $new_end_date])->get();

        return view('sale.show_sale_perform.show_sale_perform_by_range')->with('result',$result)->with('sale',$sale)->with('start_date',$start_date)->with('end_date',$end_date);
    }

}   

?>