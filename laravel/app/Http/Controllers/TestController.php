<?php
/**
 * Created by PhpStorm.
 * User: 信、仰
 * Date: 2017/9/26
 * Time: 14:49
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
class TestController extends  Controller
{
    public function article($id=null)
    {
        $res=DB::select('select * from test where id=?',[$id]);
        dd($res);
    }
    public function add()
    {
//        $res=DB::table('test')->insert([
//            ['title'=>'标题1','content'=>'内容1','author'=>'作者1','time'=>time()],
//            ['title'=>'标题2','content'=>'内容2','author'=>'作者2','time'=>time()],
//            ['title'=>'标题3','content'=>'内容3','author'=>'作者3','time'=>time()],
//            ['title'=>'标题4','content'=>'内容4','author'=>'作者4','time'=>time()]
//        ]);
//        dd($res);
        $n=Test::create(['title'=>'标题5','content'=>'内容5','author'=>'作者5','time'=>time()]);
        dd($n);
    }

    public function delete($id)
    {
        //返回受影响行数
        $n=Test::destroy($id);
        dd($n);
    }
    public function update()
    {

    }

}

