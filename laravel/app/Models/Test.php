<?php
/**
 * Created by PhpStorm.
 * User: 信、仰
 * Date: 2017/9/26
 * Time: 15:47
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Test extends Model
{
    protected $table='test';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable = [
        'title',
        'author',
        'time',
        'content',
    ];//表示title,author,time,content可以直接填充

}