<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

    class Dorm extends Model
    {
        protected $table = 'dorms';


        public function build()
        {
            return $this->belongsTo(Build::class, 'build_id','id');
        }
        public function student()
        {
            return $this->hasMany(Student::class,'dorm_id','id');
        }
        public function question(){
            return $this->hasMany(student::class,'dorm_id','id');
        }
        public function scopeDorms()
        {
                return $this->all();
        }
        public function parent()
        {
            return $this->belongsTo(Build::class, 'build_id','id');
        }
        public function children()
        {
            return $this->hasMany(Dorm::class, 'dorm_id','id');
        }

        public function brothers()
        {
            return $this->parent->children();
        }

        public static function options($id)
        {
            if (! $self = static::find($id)) {
                return [];
            }
            return $self->brothers()->pluck('dorm_name', 'id');
        }
        //当添加/删除学生后修改可住人数
        public function scopeLack($method='add',$dorm_id){
            $num=DB::table('dorm')->where('id',$dorm_id)->value('num');
            $old=DB::table('users')->where('dorm_id',$dorm_id)->count();
            $n=$num-$old;
            if($method=='add'){
                if($num>$old){
                    DB::table('dorm')->where('dorm_id',$dorm_id)->update(['lack' => $n]);
//                    DB::table('dorm')->decrement('lack', 1, ['id' =>$dorm_id ]);
                }
            }
        }
    }
