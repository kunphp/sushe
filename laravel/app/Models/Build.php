<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    public function dorm()
    {
        return $this->hasMany(Dorm::class, 'build_id', 'id');
    }
    public  function scopeLists()
    {
        return $this->all();
    }
    public function student()
    {
        return $this->hasMany(Student::class,'build_id','id');
    }
    public function foreign()
    {
        return $this->hasMany(Foreign::class,'build_id','id');
    }
}
