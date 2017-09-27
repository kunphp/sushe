<?php

namespace App\Admin\Controllers;

use App\Models\Build;

use App\Models\Dorm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BuildController extends Controller
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

            $content->header('宿舍楼');
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

            $content->header('宿舍楼');
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

            $content->header('宿舍楼');
            $content->description('编辑');

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
        return Admin::grid(Build::class, function (Grid $grid) {
            $grid->disableCreation();
            $grid->id('ID')->sortable();
            $grid->build_name('宿舍楼');
            $grid->filter(function($filter){
//                // 禁用id查询框
                $filter->disableIdFilter();
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
        return Admin::form(Build::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('build_name','宿舍楼')->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }
}
