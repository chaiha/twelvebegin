<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approvement extends Model
{
    protected $table = 'approvement';

    public function record()
    {
        return $this->hasOne('App\Record','id','record_id');
    }
}
