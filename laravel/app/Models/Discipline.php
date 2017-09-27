<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    public function dorm()
    {
        return $this->belongsTo(Dorm::class, 'dorm_id','id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','id');
    }

}
