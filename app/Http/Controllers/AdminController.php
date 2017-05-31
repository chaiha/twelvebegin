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
use App\LogAdminInsertRecord;
use App\YesRecords;
use App\SaleRecordYesCollection;
use Excel;
use Cookie;
//use Symfony\Component\HttpFoundation\Cookie;

class AdminController extends Controller
{
    public function test_sentitnel()
    {
        $user = Sentinel::check();
        print_r($user);
        echo "<br /><br /><br />";
        echo $user->id;
    }
    public function test_date()
    {
        $today = date('Y-m-d');
        $plus30 = date('Y-m-d', strtotime('+1 month', strtotime($today)));
        $plus60 = date('Y-m-d', strtotime('+2 month', strtotime($today)));

        echo "today=".$today;
        echo "<br />";
        echo "next month".$plus30;
        echo "<br />";
        echo "next 2 month".$plus60;
    }

    public function insert_record_to_select_record()
    {
        $record = DB::table('merge_leads_ext')->where('exec','=','0')->get();
        
            foreach($record as $selected_record_each)
            {
                $dt = date("Y-m-d");
                $user = Sentinel::check();
                $select_record_extend = new SelectRecord;

                $select_record_extend->sources = $selected_record_each->sources;
                $select_record_extend->categories = $selected_record_each->categories;
                $select_record_extend->dtac_type = $selected_record_each->dtac_type;
                $select_record_extend->shop_type = $selected_record_each->shop_type;
                $select_record_extend->special_type = $selected_record_each->special_type;
                $select_record_extend->name_th = $selected_record_each->name_th;
                $select_record_extend->name_en = $selected_record_each->name_en;
                $select_record_extend->branch = $selected_record_each->branch;
                $select_record_extend->province = $selected_record_each->province;
                $select_record_extend->contact_tel = $selected_record_each->contact_tel;
                $select_record_extend->links = $selected_record_each->links;
                $select_record_extend->remarks = $selected_record_each->remarks;

                $select_record_extend->record_id = $selected_record_each->id;
                $select_record_extend->selective_status = $selected_record_each->selective_status;
                $select_record_extend->distributed_date = date("Y-m-d"); 
                $select_record_extend->sale_id =  $selected_record_each->sale;
                $select_record_extend->available_start = date("Y-m-d");
                $select_record_extend->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
                $select_record_extend->created_at = date("Y-m-d");
                $select_record_extend->created_by = '4';
                $select_record_extend->updated_at = date("Y-m-d");
                $select_record_extend->updated_by = '4';

                $select_record_extend->save();

            }
            echo "finish";
            
    }

        public function update_info_from_records_to_select_records()
    {
        $select_record =SelectRecord::where('call_status','=',NULL)->get();
        
            foreach($select_record as $selected_record_each)
            {

                $record = DB::table('records')->where('id','=',$selected_record_each->record_id)->first();
                $select_record_update = SelectRecord::where('record_id','=',$selected_record_each->record_id)->first();
                $dt = date("Y-m-d");
                $user = Sentinel::check();

                $select_record_update->input_date = $record->input_date;
                $select_record_update->sources = $record->sources;
                $select_record_update->categories = $record->categories;
                $select_record_update->dtac_type = $record->dtac_type;
                $select_record_update->shop_type = $record->shop_type;
                $select_record_update->special_type = $record->special_type;
                $select_record_update->name_th = $record->name_th;
                $select_record_update->name_en = $record->name_en;
                $select_record_update->branch = $record->branch;
                $select_record_update->branch_amount = $record->branch_amount;
                $select_record_update->province = $record->province;
                $select_record_update->address = $record->address;
                $select_record_update->contact_person = $record->contact_person;
                $select_record_update->contact_email = $record->contact_email;
                $select_record_update->contact_tel = $record->contact_tel;
                $select_record_update->sending_address = $record->sending_address;
                $select_record_update->latitude = $record->latitude;
                $select_record_update->longtitude = $record->longtitude;
                $select_record_update->links = $record->links;
                $select_record_update->remarks = $record->remarks;

                $select_record_update->created_at = date("Y-m-d");
                $select_record_update->created_by = '4';
                $select_record_update->updated_at = date("Y-m-d");
                $select_record_update->updated_by = '4';

                $select_record_update->save();

            }
            echo "finish";
            
    }

    public function forget_cookie()
    {
        $cookie = \Cookie::forget('is_update');
        return response('view')->withCookie($cookie);
    }
    public function test_cookie()
    {
        $is_update = Cookie::get('is_update');
        echo $is_update;
    }

    public function test_update()
    {
        $record = Record::where('id','=','142')->first();
        $record->name_th = "เส้นจัส";
        $record->save();
        echo "ok";

    }

    public function check_is_update()
    {
        //check is update
        // $minutes = 1;//1 day
        //     $value = "1";
        //     $name = "is_update";
        // //     $cookie = cookie('name', 'value', $minutes);
        // Cookie::queue($name, $value, $minutes);

        $user = Sentinel::check();
        $is_update = Cookie::get('is_update');
        if($is_update!="1")
        {

            $today = date('Y-m-d');
            $next = date('Y-m-d', strtotime('+2 month', strtotime($today)));
            $today_array = explode("-", $today);
            $next_array = explode("-", $next);
            $compare_year = $next_array[0]-$today_array[0];
            if($compare_year==0)//Same year
                {
                    $compare_month = $next_array[1]-$today_array[1];
                   // echo "yyyycompare_month:".$compare_month;
                    if($compare_month>=0)
                    {
                        if($compare_month==2||$compare_month==1||$compare_month==0)
                        {
                            
                            //Update record Yes status
                            $result_yes = DB::table('records')
                            ->where('status','=','Not_Available')
                            ->where('result','=','yes')
                            ->whereMonth('yes_privilege_end', $next_array[1])
                            ->whereYear('yes_privilege_end',$next_array[0])
                            ->update(['status'=>'Available','selective_status'=>'extend','is_selected'=>'0']);
                            //return view('admin.index');

                            //Update record Reject status -> check for "effective_date" if it reach the condition , turn tha status from "Not_Available" to "Available"
                            $result_effective_date = DB::table('records')
                            ->where('status','=','Not_Available')
                            ->where('effective_date','=',$today)
                            ->where('result','=','reject')
                            ->update(['status'=>'Available','selective_status'=>'new','is_selected'=>'0']);
                            //Update record Waiting status -> check for "effective_date" if it reach the condition , turn tha status from "Not_Available" to "Available"
                            $result_effective_date = DB::table('records')
                            ->where('status','=','Not_Available')
                            ->where('effective_date','=',$today)
                            ->Where('result','=','waiting')
                            ->update(['status'=>'Available','selective_status'=>'waiting','is_selected'=>'0']);
                            //update record No reply status -> check for "effective_date" if it reach the condition , turn tha status from "Not_Available" to "Available"
                            $result_effective_date = DB::table('records')
                            ->where('status','=','Not_Available')
                            ->where('effective_date','=',$today)
                            ->Where('result','=','no_reply')
                            ->update(['status'=>'Available','selective_status'=>'noreply','is_selected'=>'0']);

                        }
                        else
                        {
                            
                            //Do nothing
                            echo "too far";
                            //return view('admin.index');
                        }
                    }
                    else
                    {
                        //Do nothing
                        echo "expired";
                        //return view('admin.index');
                    }
                }
                elseif($compare_year==1)//This use for case end-date is 2017-01-23 , before-date should be 2016-12-23
                {
                    $compare_month = $today_array[1]-$next_array[1];
                   //echo "xxxcompare_month:".$compare_month;
                    if($compare_month==11)
                    {
                        //Update record's status
                            $result_yes = DB::table('records')
                            ->where('status','=','Not_Available')
                            ->whereMonth('yes_privilege_end', $next_array[1])
                            ->whereYear('yes_privilege_end',$next_array[0])
                            ->update(['status'=>'Available']);
                            //return view('admin.index');
                    }
                    else
                    {
                        echo "a year left";
                        //return view('admin.index');
                    }
                }
                else//In case that there are more than 1 year OR it passed;
                {
                    echo "more than 1 year or it passed";
                    //return view('admin.index');
                }

            $minutes = 1440;//1 day
            $value = "1";
            $name = "is_update";
            Cookie::queue($name, $value, $minutes);
        }
        else
        {
            
        }
        
       return redirect('/admin/home');
    }

    public function index()
    {   
        
        // // $new_array = array();
        // // $x_array = ['a','b','c','d','e'];
        // // unset($x_array[1]);
        // // $i=0;
        // // foreach ($x_array as $x_array_each)
        // // {
        // //     $new_array[$i] = $x_array_each;
        // //     $i++;
        // // }
        // // print_r($new_array);
        

        // //-------------------- Excel
        // // $result = Record::all();

        // // Excel::create('records',function($excel) use ($result){
        // //     $excel->sheet('records',function($sheet) use ($result){
        // //         $sheet->loadView('admin.record.ExportRecords')->with('result',$result);
        // //     });
        // // })->export('xlsx');

        // //--------------------------
        // /*
        // Change the status from Not_Available to Available:
        // 0.Get today day month year.
        // 1.the record must has result "Yes" and status "Not_Available".
        // 2.Check the "End_Priviledge" to get the record that has this.month+1
        // 3.In case that this.month is 12 the next.month should be "1" and next.year=this.year+1
        // 4.Get the record by using command whereMonth and whereYear
        //     Example
        //         $result = DB::table('records')
        //         ->whereMonth('yes_privilege_end', '12')
        //         ->whereYear('yes_privilege_end','2016')
        //         ->get();
        // 5.After you get the records, chanage the status from Not_available to be Available and update to DB.

        // */



        // //---------------------------

        // //---Date caculate test
        // $user = Sentinel::check();
        // $last_login = $user->last_login;
        // // $cut_last_login = substr($last_login, 0,10);
        // //$cut_last_login = "2017-03-05"; for testing
        // $check_today = date('Y-m-d H:i:s');

        // //check "is this the first time admin login for today?"
        // if($is_update  $last_login)
        // {

        //     //Check record
        //     $today = date('Y-m-d');
        //     $next = date('Y-m-d', strtotime('+1 month', strtotime($today)));
        //     $today_array = explode("-", $today);
        //     $next_array = explode("-", $next);
        //     $compare_year = $next_array[0]-$today_array[0];
        //     if($compare_year==0)//Same year
        //         {
        //             $compare_month = $next_array[1]-$today_array[1];
        //             echo "compare_month:".$compare_month;
        //             if($compare_month>=0)
        //             {
        //                 if($compare_month==1||$compare_month==0)
        //                 {
        //                     //Update record's status
        //                     $result = DB::table('records')
        //                     ->where('status','=','Not_Available')
        //                     ->whereMonth('yes_privilege_end', $next_array[1])
        //                     ->whereYear('yes_privilege_end',$next_array[0])
        //                     ->update(['status'=>'Available']);
        //                     //return view('admin.index');
        //                 }
        //                 else
        //                 {
        //                     //Do nothing
        //                     echo "too far";
        //                     //return view('admin.index');
        //                 }
        //             }
        //             else
        //             {
        //                 //Do nothing
        //                 echo "expired";
        //                 //return view('admin.index');
        //             }
        //         }
        //         elseif($compare_year==1)//This use for case end-date is 2017-01-23 , before-date should be 2016-12-23
        //         {
        //             $compare_month = $today_array[1]-$next_array[1];
        //             echo "compare_month:".$compare_month;
        //             if($compare_month==11)
        //             {
        //                 //Update record's status
        //                     $result = DB::table('records')
        //                     ->where('status','=','Not_Available')
        //                     ->whereMonth('yes_privilege_end', $next_array[1])
        //                     ->whereYear('yes_privilege_end',$next_array[0])
        //                     ->update(['status'=>'Available']);
        //                     //return view('admin.index');
        //             }
        //             else
        //             {
        //                 echo "a year left";
        //                 //return view('admin.index');
        //             }
        //         }
        //         else//In case that there are more than 1 year OR it passed;
        //         {
        //             echo "more than 1 year or it passed";
        //             //return view('admin.index');
        //         }
        //     /*
        //       $result = DB::table('records')
        //         ->whereMonth('yes_privilege_end', '12')
        //         ->whereYear('yes_privilege_end','2016')
        //         ->get();          
        //     */
        //     //update status for record
        // }
        // else
        // {
        //     //Do nothing
        //     echo "same date";
        //     //return view('admin.index');
        // }
        // // $today = date('Y-m-d');
        // // $end = "2011-04-03";
        // // // $next_month =  strtotime('-1 month');
        // // $next = date('Y-m-d', strtotime('+1 month', strtotime($today)));
        
        // // echo "Today:".$today."<br />";
        // // echo "end:".$end."<br />";
        // // echo "Next:".$next."<br />";
        // // $today_array = explode("-", $today);
        // // $next_array = explode("-", $next);

        // // $compare_year = $next_array[0]-$today_array[0];
        // // echo $compare_year;
        // // echo "<br />";
        // // if($compare_year==0)
        // // {
        // //     $compare_month = $next_array[1]-$today_array[1];
        // //     echo $compare_month;
        // //     if($compare_month>=0)
        // //     {
        // //         if($compare_month==1||$compare_month==0)
        // //         {
        // //             echo "ok go go";
        // //         }
        // //         else
        // //         {
        // //             echo "too far";
        // //         }
        // //     }
        // //     else
        // //     {
        // //         echo "expired";
        // //     }
        // // }
        // // elseif($compare_year==1)//This use for case end-date is 2017-01-23 , before-date should be 2016-12-23
        // // {
        // //     $compare_month = $today_array[1]-$next_array[1];
        // //     echo $compare_month;
        // //     if($compare_month==11)
        // //     {
        // //         echo "next month ok";
        // //     }
        // //     else
        // //     {
        // //         echo "a year left";
        // //     }
        // // }
        // // else//In case that there are more than 1 year OR it passed;
        // // {
        // //     echo "more than 1 year or it passed";
        // // }
        // //เมื่อ admin ทำการ login เข้ามาแล้ว มันจะเข้าสู่ function นี้เพื่อทำการ check status ของ record กับ priviledge end
        // //หากว่า record นั้นๆ ใกล้วันที่จะหมดอายุ priviledge แล้ว มันจะทำการเปลี่ยนให้เป็น available ขึ้นมาเพื่อให้ทำให้ admin
        // //สามารถเลือกไปให้ sale โทรได้

        //--- original
        return view('admin.index');
    }
    
    public function earnings()
    {
        return "result 9999";
    }

    //-----from RecordController
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
        $record['longtitude'] = $request->input('longtitude');
        $record['shop_type'] = $request->input('shop_type');
        $record['special_type'] = $request->input('special_type');
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
        $user = Sentinel::check(); 
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
        $record->longtitude = $request->input('longtitude');
        $record->shop_type = $request->input('shop_type');
        $record->special_type = $request->input('special_type');
        $record->contact_person = $request->input('contact_person');
        $record->contact_email = $request->input('contact_email');
        $contact_date = $request->input('contact_year')."-".$request->input('contact_day')."-".$request->input('contact_month');
        $record->contact_date = $contact_date;
        
        $record->province = $request->input('province');
        $record->links = $request->input('links');
        $record->remarks = $request->input('remarks');
        $record->created_by = $user->id;
        $record->created_at = date("Y-m-d H:i:s");
        $record->updated_by = $user->id;
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
        $record['longtitude'] = $request->input('longtitude');
        $record['shop_type'] = $request->input('shop_type');
        $record['special_type'] = $request->input('special_type');
        $record['contact_person'] = $request->input('contact_person');
        $record['contact_email'] = $request->input('contact_email');
        // $record['contact_day'] = $request->input('contact_day');
        // $record['contact_month'] = $request->input('contact_month');
        // $record['contact_year'] = $request->input('contact_year');
        $record['contact_date'] = $request->input('contact_date');
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
        $user = Sentinel::check();

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
        $record->longtitude = $request->input('longtitude');
        $record->shop_type = $request->input('shop_type');
        $record->special_type = $request->input('special_type');
        $record->contact_person = $request->input('contact_person');
        $record->contact_email = $request->input('contact_email');
        $contact_date = $request->input('contact_year')."-".$request->input('contact_day')."-".$request->input('contact_month');
        $record->contact_date = $contact_date;
        
        $record->province = $request->input('province');
        $record->links = $request->input('links');
        $record->remarks = $request->input('remarks');
        $record->created_by = $user->id;
        $record->created_at = date("Y-m-d H:i:s");
        $record->updated_by = $user->id;
        $record->updated_at = date("Y-m-d H:i:s");
        $record->save();

        return redirect('/admin/record/success_edit_reocord');
    }

    public function success_edit_reocord()
    {
        return view('admin.record.success_edit_record');
    }

    //----from SelectRecordController
    public function select_sale()
    {
        $role = Sentinel::findRoleById(3);
        $sale_list = $role->users()->with('roles')->get();
        $sale_list_id = array();
        $n=0;
        // foreach ($sale_list as $sale_list_each)
        // {
        //     if(!(SelectRecord::is_selected_sale($sale_list_each->id)))
        //     {
        //         $sale_list_id[$n]=$sale_list_each->id;
        //     }
        //     $n++;
        // }
        
        // $new_sale_list = array();
        // $n = 0;
        // foreach ($sale_list_id as $sale_list_id_each)
        // {
        //     $new_sale_list[$n] = Sentinel::findById($sale_list_id_each);
        //     $n++;
        // }
         return view('admin.select.select_sale')->with('sale_list',$sale_list);
    }

    public function select_record($id)
    {
        Session::forget('mem_sale');
        Session::forget('mem_selected_record');
        Session::forget('mem_selected_record_list');
        Session::forget('mem_selected_record_extend');
        Session::forget('mem_selected_record_waiting');
        Session::forget('mem_selected_record_noreply');
        Session::forget('mem_selected_record_new');
        $select_record_array =array();
        $sale = Sentinel::findUserById($id);
        session(['mem_sale' => $sale]);
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        //print_r($select_record);
        
        if(sizeof($select_record)==0)
        {
            $select_record_array =['0'];
        }
        
        else
        {
            foreach($select_record as $select_record_each)
            {
                $select_record_array[$i]= $select_record_each->record_id;
                $i++;
            }
        }
        

        $record_list = Record::where('status','=','Available')->where('selective_status','=','extend')->whereNotIn('id',$select_record_array)->paginate(20);


        return view('admin.select.select_record')->with('sale',$sale)->with('record_list',$record_list);
        
    }

    public function filter_extend_select_record($id)
    {
        $select_record_array =array();
        $sale = Sentinel::findUserById($id);
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        $selected_array = session('mem_selected_record_extend');
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        if($selected_array!=NULL)
        {
            $record_list = Record::where('status','=','Available')->where('selective_status','=','extend')->where('is_selected','=','0')->whereNotIn('id',$select_record_array)->whereNotIn('id',$selected_array)->paginate(20);
        }
        else
        {
            $record_list = Record::where('status','=','Available')
            ->where('selective_status','=','extend')
            ->where('is_selected','=','0')
            ->whereNotIn('id',$select_record_array)
            ->paginate(20);
        }
        
        return view('admin.select.filter_extend_select_record')->with('sale',$sale)->with('record_list',$record_list);
    }

     public function filter_waiting_select_record($id)
    {
        $select_record_array =array();
        $sale = Sentinel::findUserById($id);
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        $selected_array = session('mem_selected_record_waiting');
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        if($selected_array!=NULL)
        {
            $record_list = Record::where('status','=','Available')
            ->where('selective_status','=','waiting')
            ->where('is_selected','=','0')
             ->where(function ($query) use ($id)
            {
                //$query->where('sale','=',$id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$id);
            })
            ->whereNotIn('id',$select_record_array)
            ->whereNotIn('id',$selected_array)
            ->paginate(20);
        }
        else
        {
            $record_list = Record::where('status','=','Available')
            ->where('selective_status','=','waiting')
            ->where('is_selected','=','0')
            ->where(function ($query) use ($id)
            {
                //$query->where('sale','=',$id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$id);
            })
            ->whereNotIn('id',$select_record_array)
            ->paginate(20);
        }
        
        return view('admin.select.filter_waiting_select_record')->with('sale',$sale)->with('record_list',$record_list);
    }

     public function filter_noreply_select_record($id)
    {
        $select_record_array =array();
        $sale = Sentinel::findUserById($id);
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        $selected_array = session('mem_selected_record_noreply');
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        if($selected_array!=NULL)
        {
            $record_list = Record::where('status','=','Available')
            ->where('selective_status','=','noreply')
            ->where('is_selected','=','0')
            ->where(function ($query) use ($id)
            {
                //$query->where('sale','=',$id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$id);
            })
            ->whereNotIn('id',$select_record_array)
            ->whereNotIn('id',$selected_array)->paginate(20);
        }
        else
        {
            $record_list = Record::where('status','=','Available')
            ->where('selective_status','=','noreply')
            ->where('is_selected','=','0')
            ->where(function ($query) use ($id)
            {
                //$query->where('sale','=',$id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$id);
            })
            ->whereNotIn('id',$select_record_array)
            ->paginate(20);
        }
        
        return view('admin.select.filter_noreply_select_record')->with('sale',$sale)->with('record_list',$record_list);
    }

     public function filter_new_select_record($id)
    {
        $select_record_array =array();
        $sale = Sentinel::findUserById($id);
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        $selected_array = session('mem_selected_record_new');
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        if($selected_array!=NULL)
        {
            $record_list = Record::where('status','=','Available')->where('selective_status','=','new')->where('is_selected','=','0')->whereNotIn('id',$select_record_array)->whereNotIn('id',$selected_array)->paginate(20);
        }
        else
        {
            $record_list = Record::where('status','=','Available')->where('selective_status','=','new')->where('is_selected','=','0')->whereNotIn('id',$select_record_array)->paginate(20);
        }
        return view('admin.select.filter_new_select_record')->with('sale',$sale)->with('record_list',$record_list)->with('selected_array',$selected_array);
    }

    public function add_selected_record_extend(Request $request)
    {
        //Get data then input it to session array
        $data = $request->input('selected_record');
        $sale_id = $request->input('sale_id');
        $currentPage = $request->input('currentPage');
        $selected_array = array();
        //print_r($data);
        //Check session?
        if(session('mem_selected_record_extend'))
        {
            $selected_array = session('mem_selected_record_extend');
        }
        $new_data = array_merge($selected_array,$data);
        session(['mem_selected_record_extend' => $new_data]);
        return redirect('/admin/select_record/select_sale/filter_extend/'.$sale_id.'?page='.$currentPage);
        

    }

    public function remove_selected_record_extend()
    {
        $data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
        if(session('mem_selected_record_extend'))
        {
            $selected_array = session('mem_selected_record_extend');
        }
        $new_data = array_diff($selected_array,$new_data_array);
        session(['mem_selected_record_extend' => $new_data]);
    }

    public function add_selected_record_waiting(Request $request)
    {
        //Get data then input it to session array
        $data = $request->input('selected_record');
        $sale_id = $request->input('sale_id');
        $currentPage = $request->input('currentPage');
        $selected_array = array();
        //print_r($data);
        //Check session?
        if(session('mem_selected_record_waiting'))
        {
            $selected_array = session('mem_selected_record_waiting');
        }
        $new_data = array_merge($selected_array,$data);
        session(['mem_selected_record_waiting' => $new_data]);
        return redirect('/admin/select_record/select_sale/filter_waiting/'.$sale_id.'?page='.$currentPage);

    }

    public function remove_selected_record_waiting()
    {
        $data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
        if(session('mem_selected_record_waiting'))
        {
            $selected_array = session('mem_selected_record_waiting');
        }
        $new_data = array_diff($selected_array,$new_data_array);
        session(['mem_selected_record_waiting' => $new_data]);
    }

    public function add_selected_record_noreply(Request $request)
    {
        //Get data then input it to session array
        $data = $request->input('selected_record');
        $sale_id = $request->input('sale_id');
        $currentPage = $request->input('currentPage');
        $selected_array = array();
        //print_r($data);
        //Check session?
        if(session('mem_selected_record_noreply'))
        {
            $selected_array = session('mem_selected_record_noreply');
        }
        $new_data = array_merge($selected_array,$data);
        session(['mem_selected_record_noreply' => $new_data]);
        
        return redirect('/admin/select_record/select_sale/filter_noreply/'.$sale_id.'?page='.$currentPage);
    }

    public function remove_selected_record_noreply()
    {
        $data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
        if(session('mem_selected_record_noreply'))
        {
            $selected_array = session('mem_selected_record_noreply');
        }
        $new_data = array_diff($selected_array,$new_data_array);
        session(['mem_selected_record_noreply' => $new_data]);
    }

    public function add_selected_record_new(Request $request)
    {
        //Get data then input it to session array
        $data = $request->input('selected_record');
        $sale_id = $request->input('sale_id');
        $currentPage = $request->input('currentPage');
        $selected_array = array();
        //print_r($data);
        //Check session?
        if(session('mem_selected_record_new'))
        {
            $selected_array = session('mem_selected_record_new');
        }
        $new_data = array_merge($selected_array,$data);
        session(['mem_selected_record_new' => $new_data]);

        return redirect('/admin/select_record/select_sale/filter_new_record/'.$sale_id.'?page='.$currentPage);

    }

    public function remove_selected_record_new()
    {
        $data = Input::get('data');
        $new_data_array = array();
        $new_data_array = [$data];
        $selected_array = array();
        if(session('mem_selected_record_new'))
        {
            $selected_array = session('mem_selected_record_new');
        }
        $new_data = array_diff($selected_array,$new_data_array);
        session(['mem_selected_record_new' => $new_data]);
    }

    public function reset_selected_record()
    {
        Session::forget('mem_selected_record');
    }

    public function preview_select_record(Request $request)
    {

        $selected_array_extend = session('mem_selected_record_extend');
        $selected_array_waiting = session('mem_selected_record_waiting');
        $selected_array_noreply = session('mem_selected_record_noreply');
        $selected_array_new = session('mem_selected_record_new');

        if($selected_array_extend!=NULL||$selected_array_extend!="")
        {
            $selected_record_list_extend = Record::whereIn('id',$selected_array_extend)->get();    
        }
        else
        {
            $selected_record_list_extend =NULL;
        }
        if($selected_array_waiting!=NULL||$selected_array_waiting!="")
        {
            $selected_record_list_waiting = Record::whereIn('id',$selected_array_waiting)->get();    
        }
        else
        {
            $selected_record_list_waiting=NULL;
        }
        if($selected_array_noreply!=NULL||$selected_array_noreply!="")
        {
            $selected_record_list_noreply = Record::whereIn('id',$selected_array_noreply)->get();    
        }
        else
        {
            $selected_record_list_noreply=NULL;
        }
        if($selected_array_new!=NULL||$selected_array_new!="")
        {
            $selected_record_list_new = Record::whereIn('id',$selected_array_new)->get();    
        }
        else
        {
            $selected_record_list_new=NULL;
        }
        
        $sale_id = $request->input('sale_id');
        $sale = Sentinel::findUserById($sale_id);

        session(['mem_selected_record_list_extend'=>$selected_record_list_extend]);//put select record
        session(['mem_selected_record_list_waiting'=>$selected_record_list_waiting]);//put select record
        session(['mem_selected_record_list_noreply'=>$selected_record_list_noreply]);//put select record
        session(['mem_selected_record_list_new'=>$selected_record_list_new]);//put select record
        session(['mem_sale'=>$sale]);

        // // print_r($selected_record_list_extend);
        // // echo "<br />";
        // // print_r($selected_record_list_waiting);
        // // echo "<br />";
        // // print_r($selected_record_list_noreply);
        // // echo "<br />";
        // // print_r($selected_record_list_new);
        // // echo "<br />";

        return Redirect('/admin/selected_record/select_sale/preview');
        //return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
        
    }

     public function remove_record_form_selected_list(Request $request)
    {
        $remove_record_id = $request->input('selected_record_remove_id');
        $selected_array_extend = session('mem_selected_record_extend');
        $selected_array_waiting = session('mem_selected_record_waiting');
        $selected_array_noreply = session('mem_selected_record_noreply');
        $selected_array_new = session('mem_selected_record_new');
        if($selected_array_extend!=NULL)
        {
            $key_extend = array_search($remove_record_id, $selected_array_extend);
            $string_key_extend = (string)$key_extend;
        }
        else
        {
            $string_key_extend="";
        }
        if($selected_array_waiting!=NULL)
        {
            $key_waiting = array_search($remove_record_id, $selected_array_waiting);
            $string_key_waiting = (string)$key_waiting;
        }
        else
        {
            $string_key_waiting ="";
        }
        if($selected_array_noreply!=NULL)
        {
            $key_noreply = array_search($remove_record_id, $selected_array_noreply);
            $string_key_noreply = (string)$key_noreply;
        }
        else
        {
            $string_key_noreply ="";
        }
        if($selected_array_new!=NULL)
        {
            $key_new = array_search($remove_record_id, $selected_array_new);
            $string_key_new = (string)$key_new;
        }
        else
        {
            $string_key_new="";
        }
        if($string_key_extend=="")
        {
            if($string_key_waiting=="")
            {
                if($string_key_noreply=="")
                {
                    if($string_key_new=="")
                    {
                        echo $key_new;
                    }
                    else
                    {
                        unset($selected_array_new[$key_new]);
                        session(['mem_selected_record_new' => $selected_array_new]);
                        $selected_record_list_new = Record::whereIn('id',$selected_array_new)->get();
                        session(['mem_selected_record_list_new'=>$selected_record_list_new]);//put select record
                    }
                }
                else
                {
                    unset($selected_array_noreply[$key_noreply]);
                    session(['mem_selected_record_noreply' => $selected_array_noreply]);
                    $selected_record_list_noreply = Record::whereIn('id',$selected_array_noreply)->get();
                    session(['mem_selected_record_list_noreply'=>$selected_record_list_noreply]);//put select record
                    
                }
            }
            else
            {
                unset($selected_array_waiting[$key_waiting]);
                session(['mem_selected_record_waiting' => $selected_array_waiting]);
                $selected_record_list_waiting = Record::whereIn('id',$selected_array_waiting)->get();
                session(['mem_selected_record_list_waiting'=>$selected_record_list_waiting]);//put select record
                
            }
        }
        else
        {
            unset($selected_array_extend[$key_extend]);
            session(['mem_selected_record_extend' => $selected_array_extend]);
            $selected_record_list_extend = Record::whereIn('id',$selected_array_extend)->get();
            session(['mem_selected_record_list_extend'=>$selected_record_list_extend]);//put select record  
            
            
        }
        return redirect('/admin/selected_record/select_sale/preview');
    }

    public function show_preview_select_record()
    {
        $sale = session('mem_sale');
        $selected_record_list_extend = session('mem_selected_record_list_extend');
        $selected_record_list_waiting = session('mem_selected_record_list_waiting');
        $selected_record_list_noreply = session('mem_selected_record_list_noreply');
        $selected_record_list_new = session('mem_selected_record_list_new');

        return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list_extend',$selected_record_list_extend)->with('selected_record_list_waiting',$selected_record_list_waiting)->with('selected_record_list_noreply',$selected_record_list_noreply)->with('selected_record_list_new',$selected_record_list_new);
    }

    public function submit_select_record(Request $request)
    {
        $sale = session('mem_sale');
        $selected_record_list_extend = session('mem_selected_record_list_extend');
        $selected_record_list_waiting = session('mem_selected_record_list_waiting');
        $selected_record_list_noreply = session('mem_selected_record_list_noreply');
        $selected_record_list_new = session('mem_selected_record_list_new');


        if($selected_record_list_extend!=NULL)
        {
            foreach($selected_record_list_extend as $selected_record_each)
            {
                $dt = date("Y-m-d");
                $user = Sentinel::check();
                $select_record_extend = new SelectRecord;

                $select_record_extend->input_date = $selected_record_each->input_date;
                $select_record_extend->sources = $selected_record_each->sources;
                $select_record_extend->categories = $selected_record_each->categories;
                $select_record_extend->dtac_type = $selected_record_each->dtac_type;
                $select_record_extend->shop_type = $selected_record_each->shop_type;
                $select_record_extend->special_type = $selected_record_each->special_type;
                $select_record_extend->name_th = $selected_record_each->name_th;
                $select_record_extend->name_en = $selected_record_each->name_en;
                $select_record_extend->branch = $selected_record_each->branch;
                $select_record_extend->branch_amount = $selected_record_each->branch_amount;
                $select_record_extend->province = $selected_record_each->province;
                $select_record_extend->address = $selected_record_each->address;
                $select_record_extend->contact_person = $selected_record_each->contact_person;
                $select_record_extend->contact_email = $selected_record_each->contact_email;
                $select_record_extend->contact_tel = $selected_record_each->contact_tel;
                $select_record_extend->sending_address = $selected_record_each->sending_address;
                $select_record_extend->latitude = $selected_record_each->latitude;
                $select_record_extend->longtitude = $selected_record_each->longtitude;
                $select_record_extend->links = $selected_record_each->links;
                $select_record_extend->remarks = $selected_record_each->remarks;

                $select_record_extend->record_id = $selected_record_each->id;
                $select_record_extend->selective_status = $selected_record_each->selective_status;
                $select_record_extend->distributed_date = date("Y-m-d"); 
                $select_record_extend->sale_id =  $sale->id;
                $select_record_extend->available_start = date("Y-m-d");
                $select_record_extend->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
                $select_record_extend->created_at = date("Y-m-d");
                $select_record_extend->created_by = $user->id;
                $select_record_extend->updated_at = date("Y-m-d");
                $select_record_extend->updated_by =$user->id;
                $select_record_extend->save();
                
                $record = Record::where('id','=',$selected_record_each->id)->first();
                $record->distributed_date = date("Y-m-d");
                $record->save();
                
            }
        }
        if($selected_record_list_waiting!=NULL)
        {
            foreach($selected_record_list_waiting as $selected_record_each)
            {
                $dt = date("Y-m-d");
                $user = Sentinel::check();
                $select_record_waiting = new SelectRecord;

                $select_record_waiting->input_date = $selected_record_each->input_date;
                $select_record_waiting->sources = $selected_record_each->sources;
                $select_record_waiting->categories = $selected_record_each->categories;
                $select_record_waiting->dtac_type = $selected_record_each->dtac_type;
                $select_record_waiting->shop_type = $selected_record_each->shop_type;
                $select_record_waiting->special_type = $selected_record_each->special_type;
                $select_record_waiting->name_th = $selected_record_each->name_th;
                $select_record_waiting->name_en = $selected_record_each->name_en;
                $select_record_waiting->branch = $selected_record_each->branch;
                $select_record_waiting->branch_amount = $selected_record_each->branch_amount;
                $select_record_waiting->province = $selected_record_each->province;
                $select_record_waiting->address = $selected_record_each->address;
                $select_record_waiting->contact_person = $selected_record_each->contact_person;
                $select_record_waiting->contact_email = $selected_record_each->contact_email;
                $select_record_waiting->contact_tel = $selected_record_each->contact_tel;
                $select_record_waiting->sending_address = $selected_record_each->sending_address;
                $select_record_waiting->latitude = $selected_record_each->latitude;
                $select_record_waiting->longtitude = $selected_record_each->longtitude;
                $select_record_waiting->links = $selected_record_each->links;
                $select_record_waiting->remarks = $selected_record_each->remarks;

                $select_record_waiting->record_id = $selected_record_each->id;
                $select_record_waiting->selective_status = $selected_record_each->selective_status;
                $select_record_waiting->distributed_date = date("Y-m-d"); 
                $select_record_waiting->sale_id =  $sale->id;
                $select_record_waiting->available_start = date("Y-m-d");
                $select_record_waiting->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
                $select_record_waiting->created_at = date("Y-m-d");
                $select_record_waiting->created_by = $user->id;
                $select_record_waiting->updated_at = date("Y-m-d");
                $select_record_waiting->updated_by =$user->id;
                $select_record_waiting->save();
            
                $record = Record::where('id','=',$selected_record_each->id)->first();
                $record->distributed_date = date("Y-m-d");
                $record->save();
            }
        }
        if($selected_record_list_noreply!=NULL)
        {
            foreach($selected_record_list_noreply as $selected_record_each)
            {
                $dt = date("Y-m-d");
                $user = Sentinel::check();
                $select_record_noreply = new SelectRecord;

                $select_record_noreply->input_date = $selected_record_each->input_date;
                $select_record_noreply->sources = $selected_record_each->sources;
                $select_record_noreply->categories = $selected_record_each->categories;
                $select_record_noreply->dtac_type = $selected_record_each->dtac_type;
                $select_record_noreply->shop_type = $selected_record_each->shop_type;
                $select_record_noreply->special_type = $selected_record_each->special_type;
                $select_record_noreply->name_th = $selected_record_each->name_th;
                $select_record_noreply->name_en = $selected_record_each->name_en;
                $select_record_noreply->branch = $selected_record_each->branch;
                $select_record_noreply->branch_amount = $selected_record_each->branch_amount;
                $select_record_noreply->province = $selected_record_each->province;
                $select_record_noreply->address = $selected_record_each->address;
                $select_record_noreply->contact_person = $selected_record_each->contact_person;
                $select_record_noreply->contact_email = $selected_record_each->contact_email;
                $select_record_noreply->contact_tel = $selected_record_each->contact_tel;
                $select_record_noreply->sending_address = $selected_record_each->sending_address;
                $select_record_noreply->latitude = $selected_record_each->latitude;
                $select_record_noreply->longtitude = $selected_record_each->longtitude;
                $select_record_noreply->links = $selected_record_each->links;
                $select_record_noreply->remarks = $selected_record_each->remarks;

                $select_record_noreply->record_id = $selected_record_each->id;
                $select_record_noreply->selective_status = $selected_record_each->selective_status;
                $select_record_noreply->distributed_date = date("Y-m-d"); 
                $select_record_noreply->sale_id =  $sale->id;
                $select_record_noreply->available_start = date("Y-m-d");
                $select_record_noreply->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
                $select_record_noreply->created_at = date("Y-m-d");
                $select_record_noreply->created_by = $user->id;
                $select_record_noreply->updated_at = date("Y-m-d");
                $select_record_noreply->updated_by =$user->id;
                $select_record_noreply->save();
                
                $record = Record::where('id','=',$selected_record_each->id)->first();
                $record->distributed_date = date("Y-m-d");
                $record->save();
            }
        }
        if($selected_record_list_new!=NULL)
        {
            foreach($selected_record_list_new as $selected_record_each)
            {
                $dt = date("Y-m-d");
                $user = Sentinel::check();
                $select_record_new = new SelectRecord;

                $select_record_new->input_date = $selected_record_each->input_date;
                $select_record_new->sources = $selected_record_each->sources;
                $select_record_new->categories = $selected_record_each->categories;
                $select_record_new->dtac_type = $selected_record_each->dtac_type;
                $select_record_new->shop_type = $selected_record_each->shop_type;
                $select_record_new->special_type = $selected_record_each->special_type;
                $select_record_new->name_th = $selected_record_each->name_th;
                $select_record_new->name_en = $selected_record_each->name_en;
                $select_record_new->branch = $selected_record_each->branch;
                $select_record_new->branch_amount = $selected_record_each->branch_amount;
                $select_record_new->province = $selected_record_each->province;
                $select_record_new->address = $selected_record_each->address;
                $select_record_new->contact_person = $selected_record_each->contact_person;
                $select_record_new->contact_email = $selected_record_each->contact_email;
                $select_record_new->contact_tel = $selected_record_each->contact_tel;
                $select_record_new->sending_address = $selected_record_each->sending_address;
                $select_record_new->latitude = $selected_record_each->latitude;
                $select_record_new->longtitude = $selected_record_each->longtitude;
                $select_record_new->links = $selected_record_each->links;
                $select_record_new->remarks = $selected_record_each->remarks;
                
                $select_record_new->record_id = $selected_record_each->id;
                $select_record_new->selective_status = $selected_record_each->selective_status;
                $select_record_new->distributed_date = date("Y-m-d"); 
                $select_record_new->sale_id =  $sale->id;
                $select_record_new->available_start = date("Y-m-d");
                $select_record_new->available_end = date( "Y-m-d", strtotime( "$dt +7 day" ) );
                $select_record_new->created_at = date("Y-m-d");
                $select_record_new->created_by = $user->id;
                $select_record_new->updated_at = date("Y-m-d");
                $select_record_new->updated_by =$user->id;
                $select_record_new->save();
                
                $record = Record::where('id','=',$selected_record_each->id)->first();
                $record->distributed_date = date("Y-m-d");
                $record->save();
            }
        }
        return Redirect('/admin/selected_record/select_sale/success/'.$sale->id);
        
    }

    public function success_select_record($sale_id)
    {
        //copy ข้อมูลที่อยู่ใน session เพิ้อไปแสดงผล
        $sale = Sentinel::findUserById($sale_id);
        //$sale = session('mem_sale');
        Session::forget('mem_sale');
        Session::forget('mem_selected_record');
        Session::forget('mem_selected_record_list');
        Session::forget('mem_selected_record_list_extend');
        Session::forget('mem_selected_record_list_waiting');
        Session::forget('mem_selected_record_list_noreply');
        Session::forget('mem_selected_record_list_new');
        //ทำการ ลบ ข้อมูลที่อยู่ใน session ออก
        return view('admin.select.success')->with('sale',$sale);
    }

    public function create_new_record_list()
    {
        return view('admin.record.create_new_record_list');
    }

    public function preview_new_record_list(Request $request)
    {
        $record_list_array = array();
        $j=0;
        for ($i=1; $i<=20 ; $i++) 
        { 

            if($request->input('sources-'.$i)!="empty")
            {
                $record_list_array[$j]['sources'] = $request->input('sources-'.$i);
                $record_list_array[$j]['categories'] = $request->input('categories-'.$i);
                $record_list_array[$j]['dtac_type'] = $request->input('dtac_type-'.$i);
                $record_list_array[$j]['shop_type'] = $request->input('shop_type-'.$i);
                $record_list_array[$j]['special_type'] = $request->input('special_type-'.$i);
                $record_list_array[$j]['name_th'] = $request->input('name_th-'.$i);
                $record_list_array[$j]['name_en'] = $request->input('name_en-'.$i);
                $record_list_array[$j]['branch'] = $request->input('branch-'.$i);
                $record_list_array[$j]['province'] = $request->input('province-'.$i);
                $record_list_array[$j]['contact_tel'] = $request->input('contact_tel-'.$i);
                $record_list_array[$j]['links'] = $request->input('links-'.$i);
                $record_list_array[$j]['remarks'] = $request->input('remarks-'.$i);
                $j++;
            }
        }

        //actualy it must be the process to check duplicated data! and then throw the error to user.
        //checking by using name_th name_en and branch and then store the data to session to show in preview page!

        // put array_value to session and then display to the preview page.
        session(['preview_record_list_array' => $record_list_array]);

        //return to the preview page
        return Redirect('/admin/record/show_preview_new_record_list');

    }

    public function show_preview_new_record_list()
    {
           $preview_new_record_list = session('preview_record_list_array');
           return view('admin.record.show_preview_new_record_list')->with('preview_new_record_list',$preview_new_record_list);
    }

    public function edit_duplicate_new_record_list($id_array)
    {
        $array_new_record = session('preview_record_list_array');
        $edit_array_new_record = $array_new_record[$id_array];
        $search_result = Record::where('name_th','=',$edit_array_new_record['name_th'])->orwhere('name_en','=',$edit_array_new_record['name_en'])->get();
        
        return view('admin.record.edit_duplicate_new_record_list')->with('search_result',$search_result)->with('edit_duplicate_record',$edit_array_new_record)->with('id_array',$id_array);

    }

    public function submit_edit_duplicate_new_record_list(Request $request)
    {
        $id_array = $request->input('id_array');
        $array_new_record = session('preview_record_list_array');
        $array_new_record[$id_array]['sources'] = $request->input('sources_edit');
        $array_new_record[$id_array]['categories'] = $request->input('categories_edit');
        $array_new_record[$id_array]['dtac_type'] = $request->input('dtac_type_edit');
        $array_new_record[$id_array]['shop_type'] = $request->input('shop_type_edit');
        $array_new_record[$id_array]['special_type'] = $request->input('special_type');
        $array_new_record[$id_array]['name_th'] = $request->input('name_th_edit');
        $array_new_record[$id_array]['name_en'] = $request->input('name_en_edit');
        $array_new_record[$id_array]['branch'] = $request->input('branch_edit');
        $array_new_record[$id_array]['province'] = $request->input('province_edit');
        $array_new_record[$id_array]['contact_tel'] = $request->input('contact_tel_edit');
        $array_new_record[$id_array]['links'] = $request->input('links_edit');
        $array_new_record[$id_array]['remarks'] = $request->input('remarks_edit');

        session(['preview_record_list_array' => $array_new_record]);
        return Redirect('/admin/record/show_preview_new_record_list');

    }

    public function edit_new_record_list()
    {
        $edit_new_record_list = session('preview_record_list_array');
        return view('admin.record.edit_new_record_list')->with('edit_new_record_list',$edit_new_record_list);
    }
     public function submit_edit_new_record_list(Request $request)
    {
        
        $size_array = $request->input('size_array');
        $record_list_array = array();
        $j=0;
        for ($i=1; $i<=$size_array ; $i++) 
        { 

            if($request->input('sources-'.$i)!="empty")
            {
                $record_list_array[$j]['sources'] = $request->input('sources-'.$i);
                $record_list_array[$j]['categories'] = $request->input('categories-'.$i);
                $record_list_array[$j]['dtac_type'] = $request->input('dtac_type-'.$i);
                $record_list_array[$j]['shop_type'] = $request->input('shop_type-'.$i);
                $record_list_array[$j]['special_type'] = $request->input('special_type-'.$i);
                $record_list_array[$j]['name_th'] = $request->input('name_th-'.$i);
                $record_list_array[$j]['name_en'] = $request->input('name_en-'.$i);
                $record_list_array[$j]['branch'] = $request->input('branch-'.$i);
                $record_list_array[$j]['province'] = $request->input('province-'.$i);
                $record_list_array[$j]['contact_tel'] = $request->input('contact_tel-'.$i);
                $record_list_array[$j]['links'] = $request->input('links-'.$i);
                $record_list_array[$j]['remarks'] = $request->input('remarks-'.$i);
                $j++;
            }
        }
         session(['preview_record_list_array' => $record_list_array]);

        //return to the preview page
        return Redirect('/admin/record/show_preview_new_record_list'); 
    }

    public function delete_new_record_list($id_array)
    {
        $new_array =array();
        $edit_new_record_list = session('preview_record_list_array');
        unset($edit_new_record_list[$id_array]);
        $i=0;
        foreach ($edit_new_record_list as $edit_new_record_list_each)
        {
            $new_array[$i] = $edit_new_record_list_each;
            $i++;
        }

       session(['preview_record_list_array' => $new_array]);

       return redirect('/admin/record/edit_new_record_list');

    }

    public function submit_new_record_list(Request $request)
    {
        $record_list = session('preview_record_list_array');
        $size_of_record_list = sizeof($record_list);
        $user = Sentinel::check();
       foreach($record_list as $record_list_each)
        {
            $new_record = new Record;
            $new_record->no = $new_record->next_no();
            $new_record->code = $new_record->next_code();
            $new_record->status = "Available";
            $new_record->selective_status = "new";
            $new_record->effective_date = date('Y-m-d');
            $new_record->sources = $record_list_each['sources'];
            $new_record->categories = $record_list_each['categories'];
            $new_record->dtac_type = $record_list_each['dtac_type'];
            $new_record->shop_type = $record_list_each['shop_type'];
            $new_record->special_type = $record_list_each['special_type'];
            $new_record->name_th = $record_list_each['name_th'];
            $new_record->name_en = $record_list_each['name_en'];
            $new_record->branch = $record_list_each['branch'];
            $new_record->province = $record_list_each['province'];
            $new_record->contact_tel = $record_list_each['contact_tel'];
            $new_record->links = $record_list_each['links'];
            $new_record->remarks = $record_list_each['remarks'];
            $new_record->input_date = date('Y-m-d');
            $new_record->contact_date = date('Y-m-d');
            $new_record->created_by = $user->id;
            $new_record->created_at = date("Y-m-d H:i:s");
            $new_record->updated_by = $user->id;
            $new_record->updated_at = date("Y-m-d H:i:s");
            $new_record->save();
       }
        
        $log_admin_insert_record = new LogAdminInsertRecord;
        $log_admin_insert_record->user_id = $user->id;
        $log_admin_insert_record->number_insert_record = $size_of_record_list;
        $log_admin_insert_record->created_at = date("Y-m-d H:i:s");
        $log_admin_insert_record->created_by = $user->id;
        $log_admin_insert_record->updated_at = date("Y-m-d H:i:s");
        $log_admin_insert_record->updated_by = $user->id;
        $log_admin_insert_record->save();
        
        
       
        return redirect('/admin/record/success_new_record_list');
    }

    public function show_success_new_record_list()
    {
        return view('admin.record.success_new_record_list');
    }

    public function show_selected_list_sale($sale_id)
    {
        $selected_record_extend = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','extend')->get();
        $selected_record_waiting = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','waiting')->get();
        $selected_record_noreply = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','noreply')->get();
        $selected_record_new = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','new')->get();
        $record_list_extend = array();
        $record_list_waiting = array();
        $record_list_noreply = array();
        $record_list_new = array();
        $sale = Sentinel::findUserById($sale_id);
        return view('admin.select.show_selected_list_sale')->with('sale',$sale)->with('record_list_extend',$selected_record_extend)->with('record_list_waiting',$selected_record_waiting)->with('record_list_noreply',$selected_record_noreply)->with('record_list_new',$selected_record_new);
    }

    public function show_sale_list()
    {
        // $users = DB::table('users')
        //     ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        //     ->get();
            //$today = date('Y-m-d');
            $today = date('Y-m-d');
            $result = DB::table('select_record')
            ->select([DB::raw('count(*) as record_count, sale_id')])
                     ->where('can_approve','<=',$today)
                     ->where('sending_status','=','sent')
                     ->where('is_admin_submit_approve','=','0')
                     //->orWhere('sending_status','=','approve')
                     //->orWhere('sending_status','=','not_approve')
                     ->groupBy('sale_id')
            ->leftJoin('users','select_record.sale_id','=','users.id')
            ->get();

        //print_r($users);
        return view('admin.approve.select_sale_approve_list')->with('result',$result);
    }

    public function show_waiting_approve($sale_id)
    {
        $today = date('Y-m-d');
        $sale = Sentinel::findUserById($sale_id);
        $record_list_extend = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','extend')->where('can_approve','<=',$today)->whereIn('sending_status',['sent','approve','not_approve'])->get();
        $record_list_waiting = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','waiting')->where('can_approve','<=',$today)->whereIn('sending_status',['sent','approve','not_approve'])->get();
        $record_list_noreply = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','noreply')->where('can_approve','<=',$today)->whereIn('sending_status',['sent','approve','not_approve'])->get();
        $record_list_new = SelectRecord::where('sale_id','=',$sale_id)->where('selective_status','=','new')->where('can_approve','<=',$today)->whereIn('sending_status',['sent','approve','not_approve'])->get();

        //print_r($record_list_extend);

       return view('admin.approve.show_waiting_approve')->with('record_list_extend',$record_list_extend)->with('record_list_waiting',$record_list_waiting)->with('record_list_noreply',$record_list_noreply)->with('record_list_new',$record_list_new)->with('sale',$sale);
    }

    public function show_record_detail($record_id,$sale_id)
    {
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id',$sale_id)->first();
        return view('admin.approve.show_record_detail')->with('select_record',$select_record);
    }

    public function submit_approve_record(Request $request)
    {
        $user = Sentinel::check();
        $record_id = $request->input('record_id');
        $sale_id = $request->input('sale_id');
        $result = $request->input('result');
        $is_approve = $request->input('is_approve');
        $admin_message = $request->input('admin_message');
        if($is_approve=="approve")
        {
            $sending_status = "approve";
        }
        elseif($is_approve=="not_approve")
        {
            $sending_status = "not_approve";
        }

        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$sale_id)->first();
        $select_record->sending_status = $sending_status;
        $select_record->admin_message = $admin_message;
        if($result=="yes")
        {
            $select_record->admin_has_reply_doc=$request->input('admin_has_reply_doc');
            $select_record->admin_has_confirm_product_img=$request->input('admin_has_confirm_product_img');
            $select_record->admin_has_confirm_logo_img=$request->input('admin_has_confirm_logo_img');
            $select_record->admin_has_shop_img=$request->input('admin_has_shop_img');
            $select_record->admin_has_product_img=$request->input('admin_has_product_img');
            $select_record->admin_has_logo_img=$request->input('admin_has_logo_img');

        }
        else
        {
            $select_record->admin_has_reply_doc=NULL;
            $select_record->admin_has_confirm_product_img=NULL;
            $select_record->admin_has_confirm_logo_img=NULL;
            $select_record->admin_has_shop_img=NULL;
            $select_record->admin_has_product_img=NULL;
            $select_record->admin_has_logo_img=NULL;
        }
        $select_record->updated_at = date('Y-m-d H:i:s');
        $select_record->updated_by = $user->id;
        $select_record->save();
        return redirect('/admin/approve_record_from_sale/select_sale/'.$sale_id);
    }

    public function submit_all_approve_record(Request $request)
    {
        $today = date('Y-m-d');
        $lot_no_number_1 = $request->input('lot_no_number_1');
        $lot_no_number_2 = $request->input('lot_no_number_2');
        $lot_no_month = $request->input('lot_no_month');
        $lot_no = $lot_no_number_1."-".$lot_no_number_2."-".$lot_no_month;
        $new_lot_no_month = explode('-', $lot_no_month);
        $user = Sentinel::check();
        $sale_id = $request->input('sale_id');
        $result = SelectRecord::where('sale_id','=',$sale_id)->get();

        foreach ($result as $result_each) 
        {
            if($result_each->sending_status=="approve")
            {
                /*
                ถ้าหากว่าได้ทำการ approve แล้วจะต้องทำการแยก select_record ออกมาตาม result
                ในแต่ละ result จะทำการ อัพเดท record ในแบบต่างๆกันไป
                */
                if($result_each->result=="yes")
                {
                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->sending_status = "approve";
                    $select_record->updated_at = date('Y-m-d H:i:s');
                    $select_record->updated_by = $user->id;

                    //Available_start must be before priviledge_end 1 month.
                    $yes_privilege_end = $result_each->yes_privilege_end;
                    $available_start = date('Y-m-d', strtotime('-1 month', strtotime($yes_privilege_end)));

                    //Insert record to yes_record table
                    $yes_record = new YesRecords;
                    $yes_record->lot_date = date('Y-m-d');
                    $yes_record->lot_no = $lot_no;
                    $yes_record->month = $new_lot_no_month[0];
                    $yes_record->approve_date = date('Y-m-d');
                    $yes_record->record_id = $result_each->record_id;
                    $yes_record->sale_id = $result_each->sale_id;
                    $yes_record->available_start = $available_start;
                    $yes_record->available_end = NULL;
                    $yes_record->call_amount = $result_each->call_amount;
                    $yes_record->result = $result_each->result;
                    $yes_record->result_date = $result_each->result_date;
                    $yes_record->yes_lot_no = date('Y-m-d');
                    $yes_record->yes_sale_name = $result_each->yes_sale_name;
                    $yes_record->yes_privilege_start = $result_each->yes_privilege_start;
                    $yes_record->yes_privilege_end = $result_each->yes_privilege_end;
                    $yes_record->yes_feedback = $result_each->yes_feedback;
                    $yes_record->yes_condition = $result_each->yes_condition;
                    $yes_record->sending_address = $result_each->sending_address;
                    $yes_record->result_remark = $result_each->result_remark;
                    $yes_record->has_reply_doc = $result_each->has_reply_doc;
                    $yes_record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $yes_record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $yes_record->has_shop_img = $result_each->has_shop_img;
                    $yes_record->has_product_img = $result_each->has_product_img;
                    $yes_record->has_logo_img = $result_each->has_logo_img;
                    $yes_record->created_at = $select_record->created_at;
                    $yes_record->created_by = $select_record->created_by;
                    $yes_record->updated_at = date('Y-m-d H:i:s');
                    $yes_record->updated_by = $user->id;
                    $yes_record->save();

                    $sale_record_yes_collection = new SaleRecordYesCollection;
                    $sale_record_yes_collection->lot_no = $lot_no;
                    $sale_record_yes_collection->month = $new_lot_no_month[0];
                    $sale_record_yes_collection->approve_date = date('Y-m-d');
                    $sale_record_yes_collection->record_id = $result_each->record_id;
                    $sale_record_yes_collection->sale_id = $result_each->sale_id;
                    $sale_record_yes_collection->name_th = $result_each->name_th;
                    $sale_record_yes_collection->name_en = $result_each->name_en;
                    $sale_record_yes_collection->dtac_type = $result_each->dtac_type;
                    $sale_record_yes_collection->categories = $result_each->categories;
                    $sale_record_yes_collection->yes_privilege_start = $result_each->yes_privilege_start;
                    $sale_record_yes_collection->yes_privilege_end = $result_each->yes_privilege_end;
                    $sale_record_yes_collection->yes_feedback = $result_each->yes_feedback;
                    $sale_record_yes_collection->yes_condition = $result_each->yes_condition;
                    $sale_record_yes_collection->has_reply_doc = $result_each->has_reply_doc;
                    $sale_record_yes_collection->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $sale_record_yes_collection->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $sale_record_yes_collection->has_shop_img = $result_each->has_shop_img;
                    $sale_record_yes_collection->has_product_img = $result_each->has_product_img;
                    $sale_record_yes_collection->has_logo_img = $result_each->has_logo_img;
                    $sale_record_yes_collection->created_at = $select_record->created_at;
                    $sale_record_yes_collection->created_by = $select_record->created_by;
                    $sale_record_yes_collection->updated_at = date('Y-m-d H:i:s');
                    $sale_record_yes_collection->updated_by = $user->id;
                    $sale_record_yes_collection->save();

                    //print_r($select_record);

                    //update table "record"
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $record->status = "Not_Available";
                    $record->is_selected = "1";
                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }   
                        $record->categories = $result_each->categories;
                        $record->shop_type = $result_each->shop_type;
                        $record->name_th = $result_each->name_th;
                        $record->name_en = $result_each->name_en;
                        $record->branch = $result_each->branch;
                        $record->address = $result_each->address;
                        $record->province = $result_each->province;
                        $record->latitude = $result_each->latitude;
                        $record->longtitude = $result_each->longtitude;
                        $record->contact_person = $result_each->contact_person;
                        $record->contact_tel = $result_each->contact_tel;
                        $record->contact_email = $result_each->contact_email;
                        $record->sending_address = $result_each->sending_address;
                        $record->links = $result_each->links;
                        $record->remarks = $result_each->remarks;

                        $record->branch_amount = $result_each->branch_amount;
                        $record->result = $result_each->result;
                        $record->selective_status = "extend";
                        $record->call_status = $result_each->call_status;
                        $record->result_date = $result_each->result_date;
                        $record->yes_lot_no = date('Y-m-d');
                        $record->yes_sale_name = $result_each->yes_sale_name;
                        $record->yes_privilege_start = $result_each->yes_privilege_start;
                        $record->yes_privilege_end = $result_each->yes_privilege_end;
                        $record->yes_feedback = $result_each->yes_feedback;
                        $record->yes_condition = $result_each->yes_condition;
                        $record->has_reply_doc = $result_each->has_reply_doc;
                        $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                        $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                        $record->has_shop_img = $result_each->has_shop_img;
                        $record->has_product_img = $result_each->has_product_img;
                        $record->has_logo_img = $result_each->has_logo_img;
                        $record->sending_address = $result_each->sending_address;
                        $record->no_reason = $result_each->no_reason;
                        $record->no_note = $result_each->no_note;
                        $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                        $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                        $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                        $record->cannot_contact_times = $result_each->cannot_contact_times;
                        $record->consider_reason = $result_each->consider_reason;
                        $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                        $record->is_tel_correct = $result_each->is_tel_correct;
                        $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                        $record->close = $result_each->close;
                        $record->result_remark = $result_each->result_remark;
                        $record->lot_date = date('Y-m-d');
                        $record->lot_no = $lot_no;
                        $record->month = $new_lot_no_month[0];
                        $record->updated_by = $user->id;
                        $record->updated_at = date('Y-m-d');
                        $record->sale = $result_each->sale_id;
                        $user_info = new User;
                        $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                        $record->save();

                        //$select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                        $select_record->delete();

                }
                elseif($result_each->result=="no_reply")
                {
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $waiting_count = $record->waiting_count;
                    $new_waiting_count = $waiting_count + 1;
                    $record->is_selected = "0";
                    if($new_waiting_count < 3 )
                    {
                        $record->status = "Available";
                        $record->selective_status = "noreply";
                        $record->waiting_count = $new_waiting_count;
                        $record->effective_date = $result_each->cannot_contact_appointment;
                    }
                    elseif($new_waiting_count >= 3 )
                    {
                        $record->status = "Not_Available";
                        $record->selective_status = "noreply";
                        $record->waiting_count = 0;
                        $record->effective_date = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    }
                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }
                    $record->categories = $result_each->categories;
                    $record->shop_type = $result_each->shop_type;
                    $record->name_th = $result_each->name_th;
                    $record->name_en = $result_each->name_en;
                    $record->branch = $result_each->branch;
                    $record->address = $result_each->address;
                    $record->province = $result_each->province;
                    $record->latitude = $result_each->latitude;
                    $record->longtitude = $result_each->longtitude;
                    $record->contact_person = $result_each->contact_person;
                    $record->contact_tel = $result_each->contact_tel;
                    $record->contact_email = $result_each->contact_email;
                    $record->sending_address = $result_each->sending_address;
                    $record->links = $result_each->links;
                    $record->remarks = $result_each->remarks;

                    $record->branch_amount = $result_each->branch_amount;
                    $record->result = $result_each->result;
                    $record->call_status = $result_each->call_status;
                    $record->result_date = $result_each->result_date;
                    $record->yes_lot_no = NULL;
                    $record->yes_sale_name = $result_each->yes_sale_name;
                    $record->yes_privilege_start = $result_each->yes_privilege_start;
                    $record->yes_privilege_end = $result_each->yes_privilege_end;
                    $record->yes_feedback = $result_each->yes_feedback;
                    $record->yes_condition = $result_each->yes_condition;
                    $record->has_reply_doc = $result_each->has_reply_doc;
                    $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $record->has_shop_img = $result_each->has_shop_img;
                    $record->has_product_img = $result_each->has_product_img;
                    $record->has_logo_img = $result_each->has_logo_img;
                    $record->sending_address = $result_each->sending_address;
                    $record->no_reason = $result_each->no_reason;
                    $record->no_note = $result_each->no_note;
                    $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                    $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                    $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                    $record->cannot_contact_times = $result_each->cannot_contact_times;
                    $record->consider_reason = $result_each->consider_reason;
                    $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                    $record->is_tel_correct = $result_each->is_tel_correct;
                    $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                    $record->close = $result_each->close;
                    $record->result_remark = $result_each->result_remark;
                    $record->lot_date = NULL;
                    $record->lot_no = NULL;
                    $record->updated_by = $user->id;
                    $record->updated_at = date('Y-m-d');
                    $record->sale = $result_each->sale_id;
                    $user_info = new User;
                    $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                    $record->save();

                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->delete();
                }
                elseif($result_each->result=="rejected")
                {
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $record->status = "Not_Available";
                    $record->is_selected = "0";
                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }
                    $record->categories = $result_each->categories;
                    $record->shop_type = $result_each->shop_type;
                    $record->name_th = $result_each->name_th;
                    $record->name_en = $result_each->name_en;
                    $record->branch = $result_each->branch;
                    $record->address = $result_each->address;
                    $record->province = $result_each->province;
                    $record->latitude = $result_each->latitude;
                    $record->longtitude = $result_each->longtitude;
                    $record->contact_person = $result_each->contact_person;
                    $record->contact_tel = $result_each->contact_tel;
                    $record->contact_email = $result_each->contact_email;
                    $record->sending_address = $result_each->sending_address;
                    $record->links = $result_each->links;
                    $record->remarks = $result_each->remarks;
                    $record->effective_date = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $record->branch_amount = $result_each->branch_amount;
                    $record->result = $result_each->result;
                    $record->call_status = $result_each->call_status;
                    $record->result_date = $result_each->result_date;
                    $record->yes_lot_no = NULL;
                    $record->yes_sale_name = $result_each->yes_sale_name;
                    $record->yes_privilege_start = $result_each->yes_privilege_start;
                    $record->yes_privilege_end = $result_each->yes_privilege_end;
                    $record->yes_feedback = $result_each->yes_feedback;
                    $record->yes_condition = $result_each->yes_condition;
                    $record->has_reply_doc = $result_each->has_reply_doc;
                    $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $record->has_shop_img = $result_each->has_shop_img;
                    $record->has_product_img = $result_each->has_product_img;
                    $record->has_logo_img = $result_each->has_logo_img;
                    $record->sending_address = $result_each->sending_address;
                    $record->no_reason = $result_each->no_reason;
                    $record->no_note = $result_each->no_note;
                    $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                    $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                    $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                    $record->cannot_contact_times = $result_each->cannot_contact_times;
                    $record->consider_reason = $result_each->consider_reason;
                    $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                    $record->is_tel_correct = $result_each->is_tel_correct;
                    $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                    $record->close = $result_each->close;
                    $record->result_remark = $result_each->result_remark;
                    $record->lot_date = NULL;
                    $record->lot_no = NULL;
                    $record->updated_by = $user->id;
                    $record->updated_at = date('Y-m-d');
                    $record->sale = $result_each->sale_id;
                    $user_info = new User;
                    $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                    $record->save();

                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->delete();
                }
                elseif($result_each->result=="waiting")
                {
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $waiting_count = $record->waiting_count;
                    $new_waiting_count = $waiting_count + 1;
                    $record->is_selected = "0";
                    if($new_waiting_count < 3 )
                    {
                        $record->status = "Available";
                        $record->selective_status = "waiting";
                        $record->waiting_count = $new_waiting_count;
                        $record->effective_date = $result_each->consider_appointment_feedback;
                    }
                    elseif($new_waiting_count >= 3 )
                    {
                        $record->status = "Not_Available";
                        $record->selective_status = "waiting";
                        $record->waiting_count = 0;
                        $record->effective_date = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    }
                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }
                    $record->categories = $result_each->categories;
                    $record->shop_type = $result_each->shop_type;
                    $record->name_th = $result_each->name_th;
                    $record->name_en = $result_each->name_en;
                    $record->branch = $result_each->branch;
                    $record->address = $result_each->address;
                    $record->province = $result_each->province;
                    $record->latitude = $result_each->latitude;
                    $record->longtitude = $result_each->longtitude;
                    $record->contact_person = $result_each->contact_person;
                    $record->contact_tel = $result_each->contact_tel;
                    $record->contact_email = $result_each->contact_email;
                    $record->sending_address = $result_each->sending_address;
                    $record->links = $result_each->links;
                    $record->remarks = $result_each->remarks;
                    $record->branch_amount = $result_each->branch_amount;
                    $record->result = $result_each->result;
                    $record->call_status = $result_each->call_status;
                    $record->result_date = $result_each->result_date;
                    $record->yes_lot_no = NULL;
                    $record->yes_sale_name = $result_each->yes_sale_name;
                    $record->yes_privilege_start = $result_each->yes_privilege_start;
                    $record->yes_privilege_end = $result_each->yes_privilege_end;
                    $record->yes_feedback = $result_each->yes_feedback;
                    $record->yes_condition = $result_each->yes_condition;
                    $record->has_reply_doc = $result_each->has_reply_doc;
                    $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $record->has_shop_img = $result_each->has_shop_img;
                    $record->has_product_img = $result_each->has_product_img;
                    $record->has_logo_img = $result_each->has_logo_img;
                    $record->sending_address = $result_each->sending_address;
                    $record->no_reason = $result_each->no_reason;
                    $record->no_note = $result_each->no_note;
                    $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                    $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                    $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                    $record->cannot_contact_times = $result_each->cannot_contact_times;
                    $record->consider_reason = $result_each->consider_reason;
                    $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                    $record->is_tel_correct = $result_each->is_tel_correct;
                    $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                    $record->close = $result_each->close;
                    $record->result_remark = $result_each->result_remark;
                    $record->lot_date = NULL;
                    $record->lot_no = NULL;
                    $record->updated_by = $user->id;
                    $record->updated_at = date('Y-m-d');
                    $record->sale = $result_each->sale_id;
                    $user_info = new User;
                    $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                    $record->save();

                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->delete();
                }
                elseif($result_each->result=="closed")
                {
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $record->status = "Not_Available";
                    $record->is_selected = "0";
                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }
                    $record->categories = $result_each->categories;
                    $record->shop_type = $result_each->shop_type;
                    $record->name_th = $result_each->name_th;
                    $record->name_en = $result_each->name_en;
                    $record->branch = $result_each->branch;
                    $record->address = $result_each->address;
                    $record->province = $result_each->province;
                    $record->latitude = $result_each->latitude;
                    $record->longtitude = $result_each->longtitude;
                    $record->contact_person = $result_each->contact_person;
                    $record->contact_tel = $result_each->contact_tel;
                    $record->contact_email = $result_each->contact_email;
                    $record->sending_address = $result_each->sending_address;
                    $record->links = $result_each->links;
                    $record->remarks = $result_each->remarks;
                    $record->effective_date = NULL;
                    $record->branch_amount = $result_each->branch_amount;
                    $record->result = $result_each->result;
                    $record->call_status = $result_each->call_status;
                    $record->result_date = $result_each->result_date;
                    $record->yes_lot_no = NULL;
                    $record->yes_sale_name = $result_each->yes_sale_name;
                    $record->yes_privilege_start = $result_each->yes_privilege_start;
                    $record->yes_privilege_end = $result_each->yes_privilege_end;
                    $record->yes_feedback = $result_each->yes_feedback;
                    $record->yes_condition = $result_each->yes_condition;
                    $record->has_reply_doc = $result_each->has_reply_doc;
                    $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $record->has_shop_img = $result_each->has_shop_img;
                    $record->has_product_img = $result_each->has_product_img;
                    $record->has_logo_img = $result_each->has_logo_img;
                    $record->sending_address = $result_each->sending_address;
                    $record->no_reason = $result_each->no_reason;
                    $record->no_note = $result_each->no_note;
                    $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                    $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                    $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                    $record->cannot_contact_times = $result_each->cannot_contact_times;
                    $record->consider_reason = $result_each->consider_reason;
                    $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                    $record->is_tel_correct = $result_each->is_tel_correct;
                    $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                    $record->close = $result_each->close;
                    $record->result_remark = $result_each->result_remark;
                    $record->lot_date = NULL;
                    $record->lot_no = NULL;
                    $record->updated_by = $user->id;
                    $record->updated_at = date('Y-m-d');
                    $record->sale = $result_each->sale_id;
                    $user_info = new User;
                    $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                    $record->save();

                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->delete();
                }
                elseif($result_each->result=="")
                {
                    $record = Record::where('id','=',$result_each->record_id)->first();
                    $record->is_selected = "0";

                    $record->status = "Available";
                    $record->selective_status = $record->selective_status;
                    $record->waiting_count = $record->waiting_count;

                    if($result_each->edit_address!="none")
                    {
                        $record->address = $result_each->edit_address;
                    }
                    if($result_each->edit_contact_person!="none")
                    {
                        $record->contact_person = $result_each->edit_contact_person;
                    }
                    if($result_each->is_tel_correct==0)
                    {
                        $record->contact_tel = $result_each->wrong_number_new_tel_number;
                    }
                    $record->categories = $result_each->categories;
                    $record->shop_type = $result_each->shop_type;
                    $record->name_th = $result_each->name_th;
                    $record->name_en = $result_each->name_en;
                    $record->branch = $result_each->branch;
                    $record->address = $result_each->address;
                    $record->province = $result_each->province;
                    $record->latitude = $result_each->latitude;
                    $record->longtitude = $result_each->longtitude;
                    $record->contact_person = $result_each->contact_person;
                    $record->contact_tel = $result_each->contact_tel;
                    $record->contact_email = $result_each->contact_email;
                    $record->sending_address = $result_each->sending_address;
                    $record->links = $result_each->links;
                    $record->remarks = $result_each->remarks;
                    $record->branch_amount = $result_each->branch_amount;
                    $record->result = $result_each->result;
                    $record->call_status = $result_each->call_status;
                    $record->result_date = $result_each->result_date;
                    $record->yes_lot_no = NULL;
                    $record->yes_sale_name = $result_each->yes_sale_name;
                    $record->yes_privilege_start = $result_each->yes_privilege_start;
                    $record->yes_privilege_end = $result_each->yes_privilege_end;
                    $record->yes_feedback = $result_each->yes_feedback;
                    $record->yes_condition = $result_each->yes_condition;
                    $record->has_reply_doc = $result_each->has_reply_doc;
                    $record->has_confirm_product_img = $result_each->has_confirm_product_img;
                    $record->has_confirm_logo_img = $result_each->has_confirm_logo_img;
                    $record->has_shop_img = $result_each->has_shop_img;
                    $record->has_product_img = $result_each->has_product_img;
                    $record->has_logo_img = $result_each->has_logo_img;
                    $record->sending_address = $result_each->sending_address;
                    $record->no_reason = $result_each->no_reason;
                    $record->no_note = $result_each->no_note;
                    $record->cannot_contact_amount_call = $result_each->cannot_contact_amount_call;
                    $record->cannot_contact_reason = $result_each->cannot_contact_reason;
                    $record->cannot_contact_appointment = $result_each->cannot_contact_appointment;
                    $record->cannot_contact_times = $result_each->cannot_contact_times;
                    $record->consider_reason = $result_each->consider_reason;
                    $record->consider_appointment_feedback = $result_each->consider_appointment_feedback;
                    $record->is_tel_correct = $result_each->is_tel_correct;
                    $record->wrong_number_new_tel_number = $result_each->wrong_number_new_tel_number;
                    $record->close = $result_each->close;
                    $record->result_remark = $result_each->result_remark;
                    $record->lot_date = NULL;
                    $record->lot_no = NULL;
                    $record->updated_by = $user->id;
                    $record->updated_at = date('Y-m-d');
                    $record->sale = $result_each->sale_id;
                    $user_info = new User;
                    $record->sale_name = $user_info->get_first_name_by_id($result_each->sale_id);
                    $record->save();

                    $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                    $select_record->delete();
                }


            }
            elseif($result_each->sending_status=="not_approve")
            {
                $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                $select_record->sending_status = "not_approve";
                $select_record->is_corrected = NULL;
                $select_record->cannot_send = NULL;
                $select_record->updated_at = date('Y-m-d H:i:s');
                $select_record->updated_by = $user->id;
                $select_record->is_admin_submit_approve = 0;
                $select_record->save();
            }
            elseif($result_each->sending_status=="sent")
            {
                $select_record = SelectRecord::where('record_id','=',$result_each->record_id)->first();
                $select_record->sending_status = NULL;
                $select_record->is_corrected = NULL;
                $select_record->cannot_send = NULL;
                $select_record->updated_at = date('Y-m-d H:i:s');
                $select_record->updated_by = $user->id;
                $select_record->is_admin_submit_approve = 0;
                $select_record->save();
            }
        }

        return redirect('/admin/approve_record_from_sale/show_sale_list');
    }

    public function list_lot_no()
    {
        $list_lot_date = DB::table('records')->select('lot_no', DB::raw('count(*) as total'))->where('result','=','yes')->where('lot_no','<>',NULL)->groupBy('lot_no')->orderBy('lot_date','desc')->paginate(20);
        
        return view('admin.export_excel.list')->with('list_lot_date',$list_lot_date);
    }

    public function show_lot_no($lot_no)
    {
        $list_lot_no = Record::where('lot_no','=',$lot_no)->get();
        $lot_no = $lot_no;
        return view('admin.export_excel.show_lot_date')->with('list_lot_no',$list_lot_no)->with('lot_no',$lot_no);
    }

    public function export_excel_by_lot_no($lot_no)
    {
        //-------------------- Excel
        $list_lot_no = Record::where('lot_no','=',$lot_no)->get();
        $file_name = "lot_".$lot_no;

        Excel::create($file_name,function($excel) use ($list_lot_no){
            $excel->sheet('records',function($sheet) use ($list_lot_no){
                $sheet->loadView('admin.export_excel.ExportRecords')->with('list_lot_no',$list_lot_no);
            });
        })->export('xlsx');

    }

    public function edit_submit_select_record($record_id,$sale_id)
    {
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$sale_id)->first();
        
        return view('admin.approve.edit_record')->with('select_record',$select_record);
    }

    public function preview_edit_submit_select_record(Request $request)
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
        $select_record['note'] = $request->input('note');

        $select_record['record_id'] = $request->input('record_id');

        // Edit for yes record
        $select_record['feedback']=$request->input('feedback');
        $select_record['condition']=$request->input('condition');
        $select_record['start_priviledge_date']=$request->input('start_priviledge_date');
        $select_record['end_priviledge_date']=$request->input('end_priviledge_date');
        /*
        $select_record['admin_has_reply_doc']=$request->input('admin_has_reply_doc');
        $select_record['admin_has_confirm_product_img']=$request->input('admin_has_confirm_product_img');
        $select_record['admin_has_confirm_logo_img']=$request->input('admin_has_confirm_logo_img');
        $select_record['admin_has_shop_img']=$request->input('admin_has_shop_img');
        $select_record['admin_has_product_img']=$request->input('admin_has_product_img');
        $select_record['admin_has_logo_img']=$request->input('admin_has_logo_img');
        */


        session(['select_record_info' => $select_record]);

        return redirect('/admin/approve_record_from_sale/show_preview_edit_info');
    }

    public function show_preview_edit_info()
    {
        $preview_record = session('select_record_info');
        $select_record = SelectRecord::where('record_id',$preview_record['record_id'])->first();
        //print_r($select_record);
        return view('admin.approve.show_preview_edit_info')->with('select_record',$preview_record)->with('select_record_info',$select_record);   
    }

    public function edit_preview_edit_info($record_id,$sale_id)
    {
        $preview_record = session('select_record_info');
        $select_record = SelectRecord::where('record_id',$preview_record['record_id'])->first();
        //print_r($select_record);
        return view('admin.approve.edit_preview_edit_info')->with('select_record',$preview_record)->with('select_record_info',$select_record);   
    }

    public function submit_edit_record_info(Request $request)
    {
        $user = session('user');
        $record_id = $request->input('record_id');
        $sale_id = $request->input('sale_id');
        $edit_record_info = session('select_record_info');
        $select_record = SelectRecord::where('record_id','=',$record_id)->first();
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
        $select_record->note = $edit_record_info['note'];

        $select_record->yes_feedback=$edit_record_info['feedback'];
        $select_record->yes_condition=$edit_record_info['condition'];

        $new_yes_privilege_start = explode('/', $edit_record_info['start_priviledge_date']);
        $new_yes_privilege_end = explode('/', $edit_record_info['end_priviledge_date']);
        $select_record->yes_privilege_start = $new_yes_privilege_start[2]."-".$new_yes_privilege_start[1]."-".$new_yes_privilege_start[0];
        $select_record->yes_privilege_end = $new_yes_privilege_end[2]."-".$new_yes_privilege_end[1]."-".$new_yes_privilege_end[0];

        /*
        $select_record->admin_has_reply_doc=$edit_record_info['admin_has_reply_doc'];
        $select_record->admin_has_confirm_product_img=$edit_record_info['admin_has_confirm_product_img'];
        $select_record->admin_has_confirm_logo_img=$edit_record_info['admin_has_confirm_logo_img'];
        $select_record->admin_has_shop_img=$edit_record_info['admin_has_shop_img'];
        $select_record->admin_has_product_img=$edit_record_info['admin_has_product_img'];
        $select_record->admin_has_logo_img=$edit_record_info['admin_has_logo_img'];
        */

        $select_record->updated_at = date('Y-m-d H:i:s');
        $select_record->updated_by = $user->id;
        $select_record->save();

        Session::forget('select_record_info');
        
        return redirect('/admin/approve_record_from_sale/success_edit_submit_record/'.$record_id.'/'.$sale_id);

    }

    public function success_edit_submit_record($record_id,$sale_id)
    {
        $select_record = SelectRecord::where('record_id','=',$record_id)->where('sale_id','=',$sale_id)->first();
        return view('admin.approve.success_edit_submit_info')->with('select_record',$select_record);
    }

    public function edit_submit_select_record_cancel($sale_id)
    {
        Session::forget('select_record_info');
        return redirect('admin/approve_record_from_sale/select_sale/'.$sale_id);
    }

}