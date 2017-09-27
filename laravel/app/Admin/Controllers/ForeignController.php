<?php

namespace App\Admin\Controllers;

use App\Models\Build;
use App\Models\Foreign;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ForeignController extends Controller
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

            $content->header('外来人员登记');
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

            $content->header('外来人员登记');
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

            $content->header('外来人员登记');
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
        return Admin::grid(Foreign::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('姓名')->editable();
            $grid->tel('手机号');
            $grid->apartment()->build_name('宿舍楼');
            $grid->desc('入楼原因')->editable('textarea');
            $states = [
                'on'  => ['text'=>'是','color' => 'success'],
                'off' => ['text'=>'否','color' => 'danger'],
            ];

            $grid->column('是否离开')->switchGroup(['status'=>'状态'],$states);
            $grid->created_at('进入时间');
            $grid->updated_at('离开时间');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableEdit();
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
        return Admin::form(Foreign::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','姓名');
            $form->mobile('tel','手机')->options(['mask' => '999 9999 9999']);
            $form->select('build_id','所进宿舍楼')->options(Build::lists()->pluck('build_name','id'))->rules('required');
            $form->textarea('desc','入楼原因')->rows(3);
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('status','是否离开')->states($states)->default('0');
            $form->display('updated_at', '更新时间');
        });
    }
}
