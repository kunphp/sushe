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


class DormController extends Controller
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

            $content->header('宿舍');
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

            $content->header('宿舍');
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

            $content->header('宿舍');
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
        return Admin::grid(Dorm::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->dorm_name('宿舍号');
            $grid->num('类型')->value(function ($active){
                return $active==4 ? '4人/间' : '8人/间';
            });
            $grid->lack('现可住人数');
            $grid->status('状态')->value(function ($status){
                return $status ? '<span class="label label-success">已满</span>' : '<span class="label label-warning">未满</span>';
            });
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
            $grid->filter(function($filter){
                $filter->is('build_id', '宿舍楼')->select(Build::lists()->pluck('build_name', 'id'));
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
        return Admin::form(Dorm::class, function (Form $form) {

            $form->text('dorm_name','宿舍号')->rules('required');
            $form->select('build_id','所属宿舍楼')->options(Build::lists()->pluck('build_name', 'id'))->rules('required');
            $form->select('num','宿舍规格')->options(['4'=>'4人/间','8'=>'8人/间']);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
