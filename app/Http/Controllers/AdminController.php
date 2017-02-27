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

class AdminController extends Controller
{
	public function index()
  	{    
        // $new_array = array();
        // $x_array = ['a','b','c','d','e'];
        // unset($x_array[1]);
        // $i=0;
        // foreach ($x_array as $x_array_each)
        // {
        //     $new_array[$i] = $x_array_each;
        //     $i++;
        // }
        // print_r($new_array);
        

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
         return view('admin.select.select_sale')->with('sale_list',$new_sale_list);
    }

    public function select_record($id)
    {
        $sale = Sentinel::findUserById($id);
        $record_list = Record::where('status','=','Available')->paginate(2);

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

    public function preview_select_record(Request $request)
    {
        $selected_array = session('mem_selected_record');
        $selected_record_list = Record::whereIn('id',$selected_array)->get();
        $sale_id = $request->input('sale_id');
        $sale = Sentinel::findUserById($sale_id);

        session(['mem_selected_record_list'=>$selected_record_list]);//put select record
        session(['mem_sale'=>$sale]);

        return Redirect('/admin/selected_record/select_sale/preview');
        //return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
        
    }

    public function show_preview_select_record()
    {
        $sale = session('mem_sale');
        $selected_record_list = session('mem_selected_record_list');
        return view('admin.select.preview_select_record')->with('sale',$sale)->with('selected_record_list',$selected_record_list);
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
        return Redirect('/admin/selected_record/select_sale/success');
        
    }

    public function success_select_record()
    {
        //copy ข้อมูลที่อยู่ใน session เพิ้อไปแสดงผล
        $sale = session('mem_sale');
        Session::forget('mem_sale');
        Session::forget('mem_selected_record');
        Session::forget('mem_selected_record_list');
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
        for ($i=1; $i<=10 ; $i++) 
        { 

            if($request->input('sources-'.$i)!="empty")
            {
                $record_list_array[$j]['sources'] = $request->input('sources-'.$i);
                $record_list_array[$j]['categories'] = $request->input('categories-'.$i);
                $record_list_array[$j]['dtac_type'] = $request->input('dtac_type-'.$i);
                $record_list_array[$j]['shop_type'] = $request->input('shop_type-'.$i);
                $record_list_array[$j]['name_th'] = $request->input('name_th-'.$i);
                $record_list_array[$j]['name_en'] = $request->input('name_en-'.$i);
                $record_list_array[$j]['branch'] = $request->input('branch-'.$i);
                $record_list_array[$j]['address'] = $request->input('address-'.$i);
                $record_list_array[$j]['province'] = $request->input('province-'.$i);
                $record_list_array[$j]['latitude'] = $request->input('latitude-'.$i);
                $record_list_array[$j]['longtitude'] = $request->input('longtitude-'.$i);
                $record_list_array[$j]['contact_person'] = $request->input('contact_person-'.$i);
                $record_list_array[$j]['contact_tel'] = $request->input('contact_tel-'.$i);
                $record_list_array[$j]['contact_email'] = $request->input('contact_email-'.$i);
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
        $search_result = Record::where('name_th','=',$edit_array_new_record['name_th'])->orwhere('name_en','=',$edit_array_new_record['name_en'])->orwhere('address','=',$edit_array_new_record['address'])->get();
        
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
        $array_new_record[$id_array]['name_th'] = $request->input('name_th_edit');
        $array_new_record[$id_array]['name_en'] = $request->input('name_en_edit');
        $array_new_record[$id_array]['branch'] = $request->input('branch_edit');
        $array_new_record[$id_array]['address'] = $request->input('address_edit');
        $array_new_record[$id_array]['province'] = $request->input('province_edit');
        $array_new_record[$id_array]['latitude'] = $request->input('latitude_edit');
        $array_new_record[$id_array]['longtitude'] = $request->input('longtitude_edit');
        $array_new_record[$id_array]['contact_person'] = $request->input('contact_person_edit');
        $array_new_record[$id_array]['contact_tel'] = $request->input('contact_tel_edit');
        $array_new_record[$id_array]['contact_email'] = $request->input('contact_email_edit');
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
                $record_list_array[$j]['name_th'] = $request->input('name_th-'.$i);
                $record_list_array[$j]['name_en'] = $request->input('name_en-'.$i);
                $record_list_array[$j]['branch'] = $request->input('branch-'.$i);
                $record_list_array[$j]['address'] = $request->input('address-'.$i);
                $record_list_array[$j]['province'] = $request->input('province-'.$i);
                $record_list_array[$j]['latitude'] = $request->input('latitude-'.$i);
                $record_list_array[$j]['longtitude'] = $request->input('longtitude-'.$i);
                $record_list_array[$j]['contact_person'] = $request->input('contact_person-'.$i);
                $record_list_array[$j]['contact_tel'] = $request->input('contact_tel-'.$i);
                $record_list_array[$j]['contact_email'] = $request->input('contact_email-'.$i);
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
        $user = Sentinel::check();
       foreach($record_list as $record_list_each)
        {
            $new_record = new Record;
            $new_record->no = $new_record->next_no();
            $new_record->code = $new_record->next_code();
            $new_record->status = "Available";
            $new_record->effective_date = date('Y-m-d');
            $new_record->sources = $record_list_each['sources'];
            $new_record->categories = $record_list_each['categories'];
            $new_record->dtac_type = $record_list_each['dtac_type'];
            $new_record->shop_type = $record_list_each['shop_type'];
            $new_record->name_th = $record_list_each['name_th'];
            $new_record->name_en = $record_list_each['name_en'];
            $new_record->branch = $record_list_each['branch'];
            $new_record->address = $record_list_each['address'];
            $new_record->province = $record_list_each['province'];
            $new_record->latitude = $record_list_each['latitude'];
            $new_record->longtitude = $record_list_each['longtitude'];
            $new_record->contact_person = $record_list_each['contact_person'];
            $new_record->contact_tel = $record_list_each['contact_tel'];
            $new_record->contact_email = $record_list_each['contact_email'];
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
       
        return redirect('/admin/record/success_new_record_list');
    }

    public function show_success_new_record_list()
    {
        return view('admin.record.success_new_record_list');
    }
}
