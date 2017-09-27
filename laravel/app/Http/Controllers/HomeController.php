<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $data['dorm']=DB::table('dorms')->where(['id' => $user->dorm_id])->value('dorm_name');;
        $data['major']=DB::table('majors')->where(['id' => $user->academy])->value('major_name');;
        return view('home',['data'=>$data,'user'=>$user]);
    }

    public function repair(Request $request){
        $dorm_id=$request->dorm_id;
        $desc=$request->desc;
        $time=date('Y-m-d H:i:s',time());
        $res = DB::table('repairs')->insert(
            ['dorm_id' => $dorm_id, 'desc' => $desc,'created_at'=>$time]
        );
        if(res){
            return redirect()->back()->withInput()->withErrors('报修成功！');
        }else{
            return redirect()->back()->withInput()->withErrors('报修失败！');

        }
    }

    public function question(Request $request){
        $title=$request->title;
        $question=$request->question;
        $student_id=$request->student_id;
        $dorm_id=$request->dorm_id;
        $time=date('Y-m-d H:i:s',time());
        $res = DB::table('questions')->insert(
            ['title' => $title, 'question' => $question,'student_id'=>$student_id,'dorm_id'=>$dorm_id,'created_at'=>$time]
        );
        if($res){
            return redirect()->back()->withInput()->withErrors('提交成功,感谢您的意见！');
        }else{
            return redirect()->back()->withInput()->withErrors('提交失败！');
        }
    }
}
