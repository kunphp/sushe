<?php

namespace App\Admin\Controllers;

use App\Models\Build;
use App\Models\Dorm;
use App\Models\Major;
use App\Models\Student;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\bootstrap;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('学生');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('学生');
            $content->description('更新');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('学生');
            $content->description('创建');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Student::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->student_name('学生')->editable();
            $grid->name('学号');
            $grid->major()->major_name('学院');
             $grid->apartment()->build_name('宿舍楼');
            $grid->dorm()->dorm_name('宿舍');
            $grid->tel('手机');
            $grid->email('邮箱');
            $grid->end_at('毕业时间');
            $grid->filter(function($filter){

                $filter->useModal();
                $filter->is('build_id', '宿舍楼')->select(Build::lists()->pluck('build_name', 'id'));
//                // 禁用id查询框
                $filter->disableIdFilter();
//                // sql: ... WHERE `user.created_at` BETWEEN $start AND $end;
                $filter->between('end_at', '毕业时间')->datetime();
//
//
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Student::class, function (Form $form) {


            $form->text('student_name','学生姓名');
            $form->text('name','学号');
            $form->select('academy','学院')->options(Major::academy()->pluck('major_name', 'id'));
            $form->select('build_id','宿舍楼')->options( Build::lists()->pluck('build_name','id'))->load('dorm_id', '/admin/api/student/dorm');
            $form->select('dorm_id','宿舍')->options(Dorm::dorms()->pluck('dorm_name', 'id'))->help('快捷输入格式例如璞3-642：p3-642');;
            $form->email('email','邮箱');
            $form->mobile('tel','手机')->options(['mask' => '999 9999 9999']);
            $form->datetime('end_at', '毕业时间')->format('YYYY-MM-DD HH:mm:ss');;
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }

//    public function dorm(Request $request)
//    {
//        $buildId = $request->get('q');
//
//        return  DB::table('dorm')->where('build_id', $buildId)->get(['id',DB::raw('dorm_name as text')]);
//    }
}
