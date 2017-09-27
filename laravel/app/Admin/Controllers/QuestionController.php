<?php

namespace App\Admin\Controllers;

use App\Models\Question;

use App\Models\Student;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class QuestionController extends Controller
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

            $content->header('意见反馈');
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
//    public function edit($id)
//    {
//        return Admin::content(function (Content $content) use ($id) {
//
//            $content->header('header');
//            $content->description('description');
//
//            $content->body($this->form()->edit($id));
//        });
//    }

    /**
     * Create interface.
     *
     * @return Content
     */


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Question::class, function (Grid $grid) {
            $grid->id('序号')->sortable();
            $grid->student()->student_name('学生');
            $grid->title('问题意见标题');
            $grid->question('具体内容');
            $grid->dorm()->dorm_name('宿舍');
            $grid->created_at('添加时间');
            $grid->actions(function ($actions) {
//                $actions->disableDelete();
            });
            $grid->disableCreation();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */

}
