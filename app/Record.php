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
        $province = array("กระบี่","กรุงเทพมหานครฯ","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา","ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา","นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี","พระนครศรีอยุธยา","พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน","ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา","สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี","สุรินทร์","หนองคาย","หนองบัวลำภู","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี");

        return $province;
    }

    // static public function shop_type_list()
    // {
    //     $shop_type_list = array("",);
    // }

    static public function check_duplicate_record($name_th,$name_en,$province)
    {
        $check_dupl_name = Record::where('name_th','=',$name_th)->orwhere('name_en','=',$name_en)->first();
        if($check_dupl_name!=NULL)
        {
            //check province is duplicate?
            if($check_dupl_name->province==$province)
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
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
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
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        $result = Record::where('selective_status','=','waiting')
        ->where(function ($query) use ($sale_id)
            {
                $query->where('sale','=',$sale_id)->orWhere('sale','=',NULL);
            })
        ->where('status','=','Available')
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function amount_noreply_record($sale_id)
    {
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        $result = Record::where('selective_status','=','noreply')
         ->where(function ($query) use ($sale_id)
            {
                $query->where('sale','=',$sale_id)->orWhere('sale','=',NULL);
            })
        ->where('status','=','Available')
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

    static public function amount_new_record()
    {
        $select_record = SelectRecord::groupBy('record_id')->get();
        $i = 0;
        foreach($select_record as $select_record_each)
        {
            $select_record_array[$i]= $select_record_each->record_id;
            $i++;
        }
        $result = Record::where('selective_status','=','new')
        ->where('status','=','Available')
        ->whereNotIn('id',$select_record_array)
        ->get();
        $size_of_result = sizeof($result);
        return $size_of_result;
    }

}
