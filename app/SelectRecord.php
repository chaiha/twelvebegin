<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectRecord extends Model
{
    protected $table = 'select_record';

    static public function check_selected_record($record_id)
    {
        if(session('mem_selected_record'))
        {
            $selected_array = session('mem_selected_record');
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
    
}
