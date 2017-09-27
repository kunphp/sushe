<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    //宿舍
    public function dorm()
    {
        return $this->belongsTo(Dorm::class,'dorm_id','id');
    }

    //宿舍楼
    public function apartment()
    {
        return $this->belongsTo(Build::class,'build_id','id');
    }

}
