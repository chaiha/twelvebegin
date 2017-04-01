<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectRecord extends Model
{
    protected $table = 'select_record';

    static public function check_selected_record_extend($record_id)
    {
        if(session('mem_selected_record_extend'))
        {
            $selected_array = session('mem_selected_record_extend');
            $result = in_array($record_id,$selected_array);
        }
        else
        {
            $result=0;
        }
        if($result=='1')
        {
            $has_record = "1";
        }
        else
        {
            $has_record ="0";
        }
        return $has_record;
    }

    static public function check_selected_record_waiting($record_id)
    {
        if(session('mem_selected_record_waiting'))
        {
            $selected_array = session('mem_selected_record_waiting');
            $result = in_array($record_id,$selected_array);
        }
        else
        {
            $result=0;
        }
        if($result=='1')
        {
            $has_record = "1";
        }
        else
        {
            $has_record ="0";
        }
        return $has_record;
    }

    static public function check_selected_record_noreply($record_id)
    {
        if(session('mem_selected_record_noreply'))
        {
            $selected_array = session('mem_selected_record_noreply');
            $result = in_array($record_id,$selected_array);
        }
        else
        {
            $result=0;
        }
        if($result=='1')
        {
            $has_record = "1";
        }
        else
        {
            $has_record ="0";
        }
        return $has_record;
    }

    static public function check_selected_record_new($record_id)
    {
        if(session('mem_selected_record_new'))
        {
            $selected_array = session('mem_selected_record_new');
            $result = in_array($record_id,$selected_array);
        }
        else
        {
            $result=0;
        }
        if($result=='1')
        {
            $has_record = "1";
        }
        else
        {
            $has_record ="0";
        }
        return $has_record;
    }

    static public function is_selected_sale($sale_id)
    {
        $result = SelectRecord::where('sale_id','=',$sale_id)->first();
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function record()
    {
        return $this->hasOne('App\Record','id','record_id');
    }

    static public function increase_call_amount($record_id)
    {
        $record = SelectRecord::where('record_id','=',$record_id)->first();
        $new_call_amount = $record->call_amount+1;
        $record->call_amount = $new_call_amount;
        $record->save();
    }
    static public function show_amount_select_record_sale($sale_id)
    {
        $result = SelectRecord::where('sale_id','=',$sale_id)->get();
        $sizeof_result = sizeof($result);
        return $sizeof_result;
    }

    static public function has_sending_status_null($sale_id)
    {
        $result = SelectRecord::where('sale_id','=',$sale_id)->where('sending_status','=',NULL)->first();

        return $result;
    }
}
