<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    static public function check_category($category_id)
    {
        switch ($category_id) {
        case "1":
            return "Dining";
            break;
        case "2":
            return "Dining & Beverage";
            break;
        case "3":
            return "Shopping & Lifestyle";
            break;
        case "4":
            return "Beauty & Healthy";
            break;
        case "5":
            return "Hotel & Travel";
            break;
        case "6":
            return "Online";
            break;
        default:
            return "Your favorite color is neither red, blue, nor green!";
        }
    }
    static public function check_category_name($category)
    {
        switch ($category) {
        case "dinning_and_beverage":
            return "Dining and Beverage";
            break;
        case "shopping_and_lifestyle":
            return "Shopping and Lifestyle";
            break;
        case "beauty_and_healthy":
            return "Beauty and Healthy";
            break;
        case "hotel_and_travel":
            return "Hotel and Travel";
            break;
        case "online":
            return "Online";
            break;
        }
    }

    static public function check_sub_category($sub_category_id)
    {

    }

    static public function check_date($date)
    {
        $array_date = array();
        $array_date = explode("-", $date);
        return $array_date;
    }

    static public function check_source($source_id)
    {
        switch ($source_id) {
        case "1":
            return "Own";
            break;
        case "2":
            return "DTAC Recommend";
            break;
        }
    }

    static public function check_type($type_id)
    {
        switch ($type_id) {
        case "1":
            return "New";
            break;
        case "2":
            return "ต่ออายุ";
            break;
        case "3":
            return "หมดอายุ";
            break;
        case "4":
            return "Rejected";
            break;
        case "5":
            return "No Replied";
            break;
        }
    }

    static public function check_result($result_id)
    {
        switch ($result_id) {
        case "1":
            return "Yes";//ร้านตอบตกลงเข้าร่วม
            break;
        case "2":
            return "No";//ร้านตอบปฏิเสธ
            break;
        case "3":
            return "Waiting";//ร้านขอพิจารณา //*
            break;
        case "5":
            return "No Reply";//ติดต่อไม่ได้ ไม่มีคนรับสาย //*
            break;
        case "7":
            return "Closed";//ร้านปิดกิจการไปแล้ว
            break;
        default:
            return "No result";//State เริ่มต้นยังไม่มีการกรอกข้อมูล
        }
    }

    static public function check_result_and_show($result)
    {
        switch ($result) {
        case "yes":
            return "Yes";//ร้านตอบตกลงเข้าร่วม
            break;
        case "rejected":
            return "Rejected";//ร้านตอบปฏิเสธ
            break;
        case "waiting":
            return "Waiting";//ร้านขอพิจารณา //*
            break;
        case "no_reply":
            return "No Reply";//ติดต่อไม่ได้ ไม่มีคนรับสาย //*
            break;
        case "closed":
            return "Closed";//ร้านปิดกิจการไปแล้ว
            break;
        default:
            return "No result";//State เริ่มต้นยังไม่มีการกรอกข้อมูล
        }
    }

    static public function increase_call_amount($record_id)
    {
        $record = Record::where('id','=',$record_id)->first();
        $new_call_amount = $record->call_amount+1;
        $record->call_amount = $new_call_amount;
        $record->save();
    }

    static public function convert_date($date)
    {
        $date = explode("-", $date);
        return $date;
    }

    public function select_record()
    {
        return $this->belongsTo('App\SelectRecord');
    }

    static public function province_list()
    {
        $province = array("กระบี่","กรุงเทพฯ","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา","ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา","นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บึงกาฬ","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี","พระนครศรีอยุธยา","พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน","ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา","สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี","สุรินทร์","หนองคาย","หนองบัวลำภู","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี");

        return $province;
    }

    // static public function shop_type_list()
    // {
    //     $shop_type_list = array("",);
    // }

    static public function check_duplicate_record($name_th,$name_en,$province)
    {
        $check_dupl_name_th = Record::where('name_th','=',$name_th)->first();
        $check_dupl_name_en = Record::where('name_en','=',$name_en)->first();

        //print_r($check_dupl_name);
        if($name_th!="-")
        {
            if($check_dupl_name_th!=NULL)
            {
                if($name_en!="-")
                {
                    if($check_dupl_name_en!=NULL)
                    {
                        if($check_dupl_name_en->province==$province)
                        {
                            return 1;
                        }
                        else
                        {
                            return 0;
                        }
                    }
                    elseif($check_dupl_name_en==NULL)
                    {
                        if($check_dupl_name_th->province==$province)
                        {
                            return 1;
                        }
                        else
                        {
                            return 0;
                        }
                    }
                }
                else //name_en=="-"
                {
                    if($check_dupl_name_th->province==$province)
                        {
                            return 1;
                        }
                        else
                        {
                            return 0;
                        }
                }
                
            }
            elseif($check_dupl_name_th==NULL)
            {
                if($name_en!="-")
                {
                    if($check_dupl_name_en!=NULL)
                    {
                        if($check_dupl_name_en->province==$province)
                        {
                            return 1;
                        }
                        else
                        {
                            return 0;
                        }
                    }
                    else
                    {
                        return 0;
                    }
                }
            }
        }
        else
        {
            if($name_en!="-")
            {
                if($check_dupl_name_en!=NULL)
                {
                    if($check_dupl_name_en->province==$province)
                    {
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                elseif($check_dupl_name_en==NULL)
                {
                    return 0;
                }
            }
            else
            {
                return 1;
            }
        }
    }

    static public function next_no()
    {
        $max_no = Record::max('no');
        $next_no = $max_no+1;
        return $next_no;
    }
    
    static public function next_code()
    {
        $max_code = Record::max('code');
        $next_code = $max_code+1;
        return $next_code;
    }

    static public function amount_extend_priviledge()
    {
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        if(sizeof($select_record)==0)
        {
            $select_record_array=[];
        }
        else
        {
            foreach($select_record as $select_record_each)
            {
                $select_record_array[$i]= $select_record_each->record_id;
                $i++;
            }
        }
        
        $result = Record::where('selective_status','=','extend')
        ->where('status','=','Available')
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function amount_waiting_record($sale_id)
    {
         $today = date('Y-m-d');
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        if(sizeof($select_record)==0)
        {
            $select_record_array=[];
        }
        else
        {
            foreach($select_record as $select_record_each)
            {
                $select_record_array[$i]= $select_record_each->record_id;
                $i++;
            }
        }
        $result = Record::where('selective_status','=','waiting')
        ->where(function ($query) use ($sale_id)
            {
                //$query->where('sale','=',$sale_id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$sale_id);
            })
        ->where('status','=','Available')
        ->whereDate('effective_date','<=',$today)
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function amount_noreply_record($sale_id)
    {
        $today = date('Y-m-d');
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        if(sizeof($select_record)==0)
        {
            $select_record_array=[];
        }
        else
        {
            foreach($select_record as $select_record_each)
            {
                $select_record_array[$i]= $select_record_each->record_id;
                $i++;
            }
        }
        
        $result = Record::where('selective_status','=','noreply')
         ->where(function ($query) use ($sale_id)
            {
                //$query->where('sale','=',$sale_id)->orWhere('sale','=',NULL);
                $query->where('sale','=',$sale_id);
            })
        ->where('status','=','Available')
        ->whereDate('effective_date','<=',$today)
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function amount_new_record()
    {
        $today = date('Y-m-d');
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        if(sizeof($select_record)==0)
        {
            $select_record_array=[];
        }
        else
        {
            foreach($select_record as $select_record_each)
            {
                $select_record_array[$i]= $select_record_each->record_id;
                $i++;
            }
        }
        
        $result = Record::where('selective_status','=','new')
        ->where('status','=','Available')
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function check_month($date)
    {
        $date_array = explode('-', $date);
        $month = $date_array[1];

        switch ($month) {
            case '01':
                $month_text = "January";
                break;
            case '02':
                $month_text = "February";
                break;
            case '03':
                $month_text = "March";
                break;
            case '04':
                $month_text = "April";
                break;
            case '05':
                $month_text = "May";
                break;
            case '06':
                $month_text = "June";
                break;
            case '07':
                $month_text = "July";
                break;
            case '08':
                $month_text = "August";
                break;
            case '09':
                $month_text = "September";
                break;
            case '10':
                $month_text = "October";
                break;
            case '11':
                $month_text = "November";
                break;
            case '12':
                $month_text = "December";
                break;
        }
        return $month_text;
    }

    static public function excel_month($date)
    {
        $date_array = explode('-', $date);
        $month = $date_array[1];
        $year_2 = substr($date_array[0],2);

        switch ($month) {
            case '01':
                $month_text = "Jan/".$year_2;
                break;
            case '02':
                $month_text = "Feb/".$year_2;
                break;
            case '03':
                $month_text = "Mar/".$year_2;
                break;
            case '04':
                $month_text = "Apr/".$year_2;
                break;
            case '05':
                $month_text = "May/".$year_2;
                break;
            case '06':
                $month_text = "June/".$year_2;
                break;
            case '07':
                $month_text = "July/".$year_2;
                break;
            case '08':
                $month_text = "Aug/".$year_2;
                break;
            case '09':
                $month_text = "Sept/".$year_2;
                break;
            case '10':
                $month_text = "Oct/".$year_2;
                break;
            case '11':
                $month_text = "Nov/".$year_2;
                break;
            case '12':
                $month_text = "Dec/".$year_2;
                break;
        }
        return $month_text;
    }

   static public function convert_date_formate($date)
    {
        $date_array = explode('-', $date);
        $new_date = $date_array[2].'/'.$date_array[1].'/'.$date_array[0];
        return $new_date;
    }

    static public function convert_datetime_to_date($datetime)
    {
        $old_date_timestamp = strtotime($datetime);
        $new_date = date('d/m/Y', $old_date_timestamp);  
        return $new_date;
    }

    static public function convert_date_format_dash($date)
    {
        $originalDate = $date;
        $newDate = date("d-m-y", strtotime($originalDate));
        return $newDate;
    }

    static public function check_sources($source)
    {
        if($source=="online_search")
        {
            return "ค้นหาจากเว็บไซต์";
        }
        elseif($source=="dtac_recommend")
        {
            return "ร้านแนะนำจาก dtac";
        }
        elseif($source=="walking")
        {
            return "Walk in";
        }
    }

    static public function find_record_no($record_id)
    {
        $result = Record::where('id','=',$record_id)->first();
        return $result->no;
    }

}
