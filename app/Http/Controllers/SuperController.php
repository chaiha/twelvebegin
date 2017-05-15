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

class SuperController extends Controller
{
	public function index()
  	{    
        return view('super.index');
  	}
  	
    public function earnings()
    {
    	return "result 9999";
    }

    //-----from RecordController
    public function list_records()
    {
        $records = Record::paginate(100);
        return view('super.record.list_records')->with('records',$records);
    }
    public function create_new_record()
    {
        
        return view('super.record.create_new_record');
        
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
        $record['longitude'] = $request->input('longitude');
        $record['shop_type'] = $request->input('shop_type');
        $record['contact_person'] = $request->input('contact_person');
        $record['contact_email'] = $request->input('contact_email');
        $record['contact_day'] = $request->input('contact_day');
        $record['contact_month'] = $request->input('contact_month');
        $record['contact_year'] = $request->input('contact_year');
        $record['province'] = $request->input('province');
        $record['links'] = $request->input('links');
        $record['remarks'] = $request->input('remarks');

        session(['new_record' => $record]);

        return redirect('/super/record/preview_new_record');

    }
    public function show_preview_new_record()
    {
        $preview_record = session('new_record');
        return view('super.record.preview_new_record')->with('record',$preview_record);
    }

    public function edit_new_record()
    {
        $edit_record = session('record');
        return view('super.record.edit_new_record')->with('record',$edit_record);
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
        $record->longitude = $request->input('longitude');
        $record->shop_type = $request->input('shop_type');
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

        return redirect('/super/record/success_create_new_reocord');
    }

    public function success_new_record()
    {
        return view('super.record.success_new_record');
    }

     public function get_edit_record($id)
    {
        $record = Record::find($id);
        return view('super.record.edit_record')->with('record',$record);
    }

    public function submit_delete_record(Request $request)
    {
        $id = $request->input('id');
        $record = Record::where('id','=',$id)->first();
        $record->delete();

        return redirect('/super/record/success_delete_record');
    }

    public function success_delete_record()
    {
        return view('super.record.success_delete_record');
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
        $record['longitude'] = $request->input('longitude');
        $record['shop_type'] = $request->input('shop_type');
        $record['contact_person'] = $request->input('contact_person');
        $record['contact_email'] = $request->input('contact_email');
        $record['contact_day'] = $request->input('contact_day');
        $record['contact_month'] = $request->input('contact_month');
        $record['contact_year'] = $request->input('contact_year');
        $record['province'] = $request->input('province');
        $record['links'] = $request->input('links');
        $record['remarks'] = $request->input('remarks');

        session(['edit_record' => $record]);

        return redirect('/super/record/preview_edit_record');
    }
    public function show_preview_edit_record()
    {
        $preview_record = session('edit_record');
        return view('super.record.preview_edit_record')->with('record',$preview_record);
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
        $record->longitude = $request->input('longitude');
        $record->shop_type = $request->input('shop_type');
        $record->contact_person = $request->input('contact_person');
        $record->contact_email = $request->input('contact_email');
        $contact_date = $request->input('contact_year')."-".$request->input('contact_day')."-".$request->input('contact_month');
        $record->contact_date = $contact_date;
        
        $record->province = $request->input('province');
        $record->links = $request->input('links');
        $record->remarks = $request->input('remarks');
        $record->updated_by =$user->id;
        $record->updated_at = date("Y-m-d H:i:s");
        $record->save();

        return redirect('/super/record/success_edit_reocord');
    }

    public function success_edit_reocord()
    {
        return view('super.record.success_edit_record');
    }

    //----from SelectRecordController
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
         return view('super.select.select_sale')->with('sale_list',$new_sale_list);
    }

    public function select_record($id)
    {
        $sale = Sentinel::findUserById($id);
        $record_list = Record::where('status','=','Available')->paginate(2);

        return view('super.select.select_record')->with('sale',$sale)->with('record_list',$record_list);
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

        return Redirect('/super/selected_record/select_sale/preview');
        //return view('super.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
        
    }

    public function show_preview_select_record()
    {
        $sale = session('mem_sale');
        $selected_record_list = session('mem_selected_record_list');
        return view('super.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
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
        return Redirect('/super/selected_record/select_sale/success');
        
    }

    public function success_select_record()
    {
        //copy ข้อมูลที่อยู่ใน session เพิ้อไปแสดงผล
        $sale = session('mem_sale');
        Session::forget('mem_sale');
        Session::forget('mem_selected_record');
        Session::forget('mem_selected_record_list');
        //ทำการ ลบ ข้อมูลที่อยู่ใน session ออก
        return view('super.select.success')->with('sale',$sale);
    }

    public function get_delete_record($id)
    {
        $record = Record::where('id','=',$id)->first();
        return view('super.record.delete_record')->with('record',$record);
    }
    public function get_setting()
    {
        $setting = Setting::all();

        return view('super.setting.index')->with('setting',$setting);
    }

    public function get_edit_setting($id)
    {
        $result = Setting::where('id','=',$id)->first();
        return view('super.setting.edit_setting')->with('result',$result);
    }

    public function submit_edit_setting(Request $request)
    {
        $user = Sentinel::check();
        $id = $request->input('id');
        $edit_setting = Setting::where('id','=',$id)->first();
        $edit_setting->value_int = $request->input('value_int');
        $edit_setting->value_char = $request->input('value_char');
        $edit_setting->updated_by = $user->id;
        $edit_setting->updated_at = date("Y-m-d H:i:s");
        $edit_setting->save();

        return redirect('/super/edit_redcord/success_edit_setting');
    }

    public function show_succes_edit_setting()
    {
        return view('super.setting.success_edit_setting');
    }

    public function list_selected_sale()
    {
        $role = Sentinel::findRoleById(3);
        $sale_list = $role->users()->with('roles')->get();
        $sale_list_id = array();
        $n=0;
        foreach ($sale_list as $sale_list_each)
        {
            if((SelectRecord::is_selected_sale($sale_list_each->id)))
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
         return view('super.select.select_sale')->with('sale_list',$new_sale_list);
    }

    public function show_selected_record_list($sale_id)
    {
        $record_list = SelectRecord::where('sale_id','=',$sale_id)->get();
        $sale = User::where('id','=',$sale_id)->first();
        return view('super.select.show_select_record_list')->with('record_list',$record_list)->with('sale',$sale);
    }

    public function list_sale_perform()
    {
        $role = Sentinel::findRoleById(3);
        $sale_list = $role->users()->with('roles')->get();
        
         return view('super.show_sale_perform.list_sale')->with('sale_list',$sale_list);
    }

    public function show_sale_perform($sale_id)
    {
        $sale = Sentinel::findUserById($sale_id);
        return view('super.show_sale_perform.show_sale_perform')->with('sale',$sale);
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

        return view('super.show_sale_perform.show_sale_perform_by_range')->with('result',$result)->with('sale',$sale)->with('start_date',$start_date)->with('end_date',$end_date);
    }

    public function export_excel_sale_perform(Request $request)
    {
        //-------------------- Excel
        $sale_id = $request->input('sale_id_submit');
        $sale = Sentinel::findUserById($sale_id);
        $start_date = $request->input('start_date_submit');
        $end_date = $request->input('end_date_submit');
        $start_date_array = explode('/', $start_date);
        $new_start_date = $start_date_array[2]."-".$start_date_array[1]."-".$start_date_array[0];
        $end_date_array = explode('/', $end_date);
        $new_end_date = $end_date_array[2]."-".$end_date_array[1]."-".$end_date_array[0];

        //Query
        $result = SaleRecordYesCollection::where('sale_id','=',$sale_id)->whereBetween('approve_date', [$new_start_date, $new_end_date])->get();
        $file_name = "export_sale_perform_sale_id_".$sale_id;
        Excel::create($file_name,function($excel) use ($result){
            $excel->sheet('records',function($sheet) use ($result){
                $sheet->loadView('super.show_sale_perform.export_excel_sale_perform')->with('result',$result);
            });
        })->export('xlsx');
    }

}
