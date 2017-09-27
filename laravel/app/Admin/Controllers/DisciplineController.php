<?php

namespace App\Admin\Controllers;


use App\Models\Discipline;
use App\Models\Dorm;
use App\Models\Student;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class DisciplineController extends Controller
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

            $content->header('违纪/表扬');
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

            $content->header('违纪/表扬');
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

            $content->header('违纪/表扬');
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
        return Admin::grid(Discipline::class, function (Grid $grid) {

            $grid->id('序号')->sortable();
            $grid->student()->student_name('学生');
            $grid->dorm()->dorm_name('宿舍');
            $grid->type('类型')->value(function ($active){
                if($active==0) return '<span class="label label-success">表扬</span>';
                else if($active==1) return '<span class="label label-success">批评</span>';
                else return '<span class="label label-danger">违纪</span>';
            });
            $grid->reason('原因')->editable('textarea');
            $grid->created_at('时间');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Discipline::class, function (Form $form) {
//            $form->text('student_name','学生')->rules('required');
            $form->select('student_name','学生')->options(Student::all()->pluck('student_name', 'id'))->rules('required');
            $form->select('dorm_id','宿舍')->options(Dorm::all()->pluck('dorm_name', 'id'))->rules('required');
            $form->select('type','类型')->options(['0'=>'表扬','1'=>'批评','2'=>'违纪']);
            $form->textarea('reason','原因')->rules('required');
            $form->display('created_at', '创建时间');
        });
    }
}
