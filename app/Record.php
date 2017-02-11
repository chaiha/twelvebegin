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

    public function select_record()
    {
        return $this->belongsTo('App\SelectRecord');
    }
    
}
