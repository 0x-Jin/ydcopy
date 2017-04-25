@extends('Admin.Layouts.main')
@section('title', '其他管理')
@section('breadcrumb')
    <li>工作管理</li>
    <li class="active">其他管理</li>
@endsection
@section('inputs')
    <div class="form-group">
        <label class="control-label">姓名：</label>
        {{ Form::input('text', 'name', old('name'), ['class'=>'form-control','id'=>'name']) }}
    </div>
    <div class="form-group">
        <label class="control-label">年龄：</label>
        {{ Form::input('text', 'age', old('age'), ['class'=>'form-control','id'=>'age']) }}
    </div>
    <div class="form-group">
        <label class="control-label">身高：</label>
        {{ Form::input('text', 'height', old('name'), ['class'=>'form-control','id'=>'height']) }}
    </div>
@endsection
@section('button')
        @parent
        <button type='button' class="btn btn-warning mr10">
            <i class="fa"></i>&nbsp;发布
        </button>
@endsection
<script>
    var index_ajax_url = '{{URL::route('user.post')}}';
    var index_ajax_token = '{{ csrf_token() }}';
    var edit_url = '{{URL::route('user.edit')}}';
    var delete_url = '{{URL::route('user.dele')}}';
    var add_url = '{{URL::route('user.add')}}';
    //定义要初始化的数据
    function init_form(){
        //所有表单初始化数据
        var form_data = {};
        form_data.name = $('#name').val();
        form_data.age = $('#age').val();
        form_data.height = $('#height').val();
        form_data._token = index_ajax_token;
        return form_data;
    };
</script>
@section('table')
<!-- DATA TABLES -->
<div class="row">
    <div class="col-md-12">
        <!-- BOX -->
        <div class="box border">
            <div class="box-title">
                <h4 style="color: #000;"><i class="fa fa-table"></i>@yield('title')表</h4>
                <div class="tools hidden-xs">
                    <a href="javascript:;" class="reload">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a href="javascript:;" class="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table id="datatable1"  style="font-size: 13px;" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
                    <thead  style="font-size: 13px;">
                            <tr>
                                <th>姓名</th>
                                <th>年龄</th>
                                <th>身高</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                    </thead>
                </table>
            </div>
            <input type="hidden" id="hide_op_id"  /><!-- 重要用于操作的主键  -->
        </div>
        <!-- /BOX -->
    </div>
</div>
<!-- /DATA TABLES -->
@endsection
<!-- 其他部分的自定义url -->
@section('js')
    @parent
    @include('Admin.Layouts.myui')
@endsection

