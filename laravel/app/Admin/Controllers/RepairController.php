<?php

namespace App\Admin\Controllers;

use App\Models\Repair;
use App\Models\Build;
use App\Models\Dorm;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Auth\Permission;

class RepairController extends Controller
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

            $content->header('设备报修');
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

            $content->header('设备报修');
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
        Permission::check('create-repair');
        Permission::allow(['学生']);
        return Admin::content(function (Content $content) {

            $content->header('设备报修');
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
        return Admin::grid(Repair::class, function (Grid $grid) {
            $grid->filter(function ($filter){
                $filter->disableIdFilter();
                $filter->is('build_id', '宿舍楼')->select(Build::all()->pluck('build_name', 'id'));
//                $filter->is('status', '维修状态')->select();

                $filter->between('created_at', '添加时间')->datetime();
            });
            $grid->id('ID')->sortable();
            $grid->apartment()->build_name('宿舍楼');
            $grid->dorm()->dorm_name('宿舍');
            $grid->desc('维修原因')->editable('textarea');;
            $states=[
                'on'  => ['text'=>'是'],
                'off' => ['text'=>'否'],];
            $grid->column('维修完成')->switchGroup(['status'=>'状态'],$states);
            $grid->created_at('添加时间');
            $grid->updated_at('完成时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Repair::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->select('build_id','宿舍楼')->options(Build::lists()->pluck('build_name','id'));
            $form->select('dorm_id','宿舍')->options(Dorm::dorms()->pluck('dorm_name','id'));
            $form->textarea('desc','报修原因');
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('status','维修完成')->states($states)->default('0');

        });
    }
}
