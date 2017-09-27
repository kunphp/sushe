<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table="users";
    //宿舍
    public function dorm()
    {
        return $this->belongsTo(Dorm::class,'dorm_id','id');
    }
    //学院
    public function major()
    {
        return $this->belongsTo(Major::class,'academy','id');
    }
    //宿舍楼
    public function apartment()
    {
        return $this->belongsTo(Build::class,'build_id','id');
    }
    public function question(){
        return $this->hasMany(Question::class, 'student_id', 'id');
    }
    public function scopeAll()
    {
        return $this->all();
    }
}
