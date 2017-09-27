<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\Map;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('首页');

            $content->row(function ($row) {
                $row->column(4, new InfoBox('问题意见', 'question', 'blue', '/admin/question',''));
                $row->column(4, new InfoBox('设备报修', 'wrench', 'red', '/admin/repair',''));
            });

            $content->row(function ($row) {
                $desc='<div><ul class="list-group">
            <li class="list-group-item">网站名: <span>洛阳理工学院宿舍管理系统</span></li>
            <li class="list-group-item">学校地址: <span>洛阳市洛龙区学子街8号</span></li>
            <li class="list-group-item">邮编地址: <span>471023 </span></li>
            <li class="list-group-item">电话: <span>0379-65928000</span></li>
            </ul></div>';
                $row->column(8, new Box('系统信息',$desc));
            });
        });
    }
}
