<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function dorm(){
        return $this->belongsTo(Dorm::class, 'dorm_id', 'id');
    }
}
