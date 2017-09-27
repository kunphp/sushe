<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foreign extends Model
{
    public function apartment()
    {
        return $this->belongsTo(Build::class,'build_id','id');
    }
}
