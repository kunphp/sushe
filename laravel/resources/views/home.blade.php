@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">欢迎您的到来</div>--}}

                {{--<div class="panel-body">--}}
                    {{--您已登录--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">个人信息</a></li>
    <li><a href="#repair" data-toggle="tab">宿舍设备报修</a></li>
    <li><a href="#question" data-toggle="tab">问题反馈</a></li>

</ul>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{!! implode('<br>', $errors->all()) !!}</strong><br>
    </div>
@endif
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="home">
        <ul class="list-group">
            <li class="list-group-item">学号: <span>{!! $user->name !!}</span></li>
            <li class="list-group-item">姓名: <span>{!! $user->student_name !!}</span></li>
            <li class="list-group-item">专业: <span>{!! $data['major'] !!}</span></li>
            <li class="list-group-item">电话: <span>{!! $user->tel !!}</span></li>
            <li class="list-group-item">邮箱: <span>{!! $user->email !!}</span></li>
            <li class="list-group-item">宿舍: <span>{!! $data['dorm'] !!}</span></li>
        </ul>
        {{--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">修改密码</button>--}}
        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
                    </div>
                    <div class="modal-body"><p>请填写下面信息</p>
                    <form role="form" action="{{ url('/home/reset') }}" method="post">

                        <div class="form-group">
                            <label for="name">新密码</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="name">确认密码</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <input type="hidden" name="id" value="{!! $user->id !!}">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
    </div>
    <div class="tab-pane fade" id="repair">
        <br>
        <br>
        <form   role="form" action="{{ url('/home/repair') }}" method="post">
            <div class="form-group">
                <label for="name">宿舍 :</label>
                <input type="text" class="form-control" name="dorm" value="{!! $data['dorm'] !!}" disabled>
            </div>
            <div class="form-group">
                <label for="name">报修原因</label>
                <textarea type="text" class="form-control" name="desc" required></textarea>
            </div>
            <input type="hidden" name="dorm_id" value="{!! $user->dorm_id !!}">
            <input type="hidden" name="build_id" value="{!! $user->build_id !!}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <button type="submit" class="btn btn-default">提交报修</button>
        </form>
    </div>
    <div class="tab-pane fade" id="question">
        <br>
        <br>
        <form   role="form" action="{{ url('/home/question') }}" method="post">
            <div class="form-group">
                <label for="name">问题意见/留言标题 :</label>
                <input type="text" class="form-control" name="title"  required>
            </div>
            <div class="form-group">
                <label for="name">具体内容</label>
                <textarea type="text" class="form-control" name="question" required></textarea>
            </div>
            <input type="hidden" name="student_id" value="{!! $user->id !!}">
            <input type="hidden" name="dorm_id" value="{!! $user->dorm_id !!}">
            <button type="submit" class="btn btn-default">留下意见</button>
        </form>
    </div>

</div>

@endsection
