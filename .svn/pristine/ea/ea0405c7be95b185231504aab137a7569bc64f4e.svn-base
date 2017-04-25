@extends('Admin.Layouts.master')
@section('title', '商品负责人')
@section('breadcrumb')
    <li>商品</li>
    <li class="active">商品负责人</li>
@endsection

@section('toolbar')
<div class="row form-inline form-ranking">
    <div class="form-group">
        <a class="btn btn-warning btn-refresh mr10" href="javascript:;">
            <i class="fa fa-refresh"></i>&nbsp;刷新
        </a>
        <a class="btn btn-primary btn-add mr10" href="javascript:;">
            <i class="fa fa-plus"></i>&nbsp;新增
        </a>
    </div>
    <div class="form-group pull-right">
        <label class="control-label">编码：</label>
        {{ Form::input('text', 'bn', '', ['class'=>'form-control mr10', 'placeholder'=>'编码']) }}
        <label class="control-label">负责人：</label>
        {{ Form::input('text', 'principal', '', ['class'=>'form-control mr10', 'placeholder'=>'负责人']) }}
        <a class="btn btn-success btn-search" href="javascript:;">
            <i class="fa fa-search"></i>&nbsp;搜索
        </a>
    </div>
</div>
@endsection

@section('table')
    <div class="row col-md-12">
        <div class="box">
            <table id="table"></table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal">
        <div class="modal-dialog" style="width: 1080px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                {{ Form::open(['url'=>'', 'id'=>'saveForm','class'=>'form-horizontal']) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::hidden('id', null) }}
                        {{ csrf_field() }}
                        {{ Form::label('bn', '商品编码', ['class'=>'control-label col-md-3']) }}
                        <div class="col-md-4">
                            {{ Form::text('bn', null, ['class'=>"form-control"]) }}
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', '商品名称', ['class'=>'control-label col-md-3']) }}
                        <div class="col-md-4">
                            {{ Form::text('name', null, ['class'=>"form-control"]) }}
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('principal', '负责人', ['class'=>'control-label col-md-3']) }}
                        <div class="col-md-4">
                            {{ Form::text('principal', null, ['class'=>"form-control"]) }}
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('extra', '备注', ['class'=>'control-label col-md-3']) }}
                        <div class="col-md-4">
                            {{ Form::text('extra', null, ['class'=>"form-control"]) }}
                            <span class="error-span"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-save">保存</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">取消</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(function(){
            $('.btn-refresh').one('click', refreshFunc = function(){
                $('#table').bootstrapTable('refresh');
                $(this).one('click', refreshFunc);
            });

            $('.btn-add').one('click', addFunc = function(){
                $('#saveForm input:not([name=_token])').val('');
                $('#saveForm').get(0).reset();
                $('.modal').modal('show');
                $(this).one('click', addFunc);
            });

            $('#table').bootstrapTable({
                url: g.current_path,
                method: 'post',
                queryParamsType: 'limit',
                queryParams: function(params){
                    params._token = g._token;
                    params.bn = $('input[name=bn]').val();
                    params.principal = $('input[name=principal]').val();
                    return params;
                },
                striped: true,
                uniqueId: 'id',
                pagination: true,
                sidePagination: 'server',
                columns: [{
                    field: 'id',
                    title: 'id'
                }, {
                    field: 'bn',
                    title: '编码'
                }, {
                    field: 'name',
                    title: '商品名称'
                }, {
                    field: 'principal',
                    title: '负责人'
                }, {
                    field: 'created_at',
                    title: '添加时间',
                    formatter: function(val, row, index){
                        var objDate = new Date(val*1000);
                        return objDate.getFullYear()+"-"+(objDate.getMonth()+1)+"-"+objDate.getDate();
                    }
                }, {
                    class: 'col-xs-1',
                    align: 'center',
                    formatter: function(val, row, index){
                        domOp = '' +
                        '<button data-id='+row.id+' class="btn btn-xs btn-info btn-edit mr10">' +
                        '   <i class="fa fa-pencil-square-o"></i>编辑' +
                        '</button>' +
                        '<button data-id='+row.id+' class="btn btn-xs btn-warning btn-del">' +
                        '   <i class="fa fa-trash-o"></i>删除' +
                        '</button>';
                        return domOp;
                    }
                }]
            });

            $('#table tbody').on('click', '.btn-edit', function(){
                var id = $(this).attr('data-id');
                var row = $('#table').bootstrapTable('getRowByUniqueId', id);
                $.each(row, function(name, v){
                    $('#saveForm [name='+name+']').val(v);
                });
                $('.modal').modal('show');
            });

            $('#table tbody').on('click', '.btn-del', function(){
                var id = $(this).attr('data-id');
                bootbox.confirm("确定要删除",function(result){
                    if(result){
                        $.post(
                            '{{ url()->current().'/del' }}',
                            { id: id, _token: g._token},
                            function(data){
                                $.gritter.add({
                                    title: '提示',
                                    text: data.msg,
                                    sticky: false,
                                    time: 1000,
                                    class_name: 'my-sticky-class'
                                });
                                $('#table').bootstrapTable('refresh');
                            }
                        );
                    }
                });
            });

            $('.btn-search').one('click', searchFunc=function(){
                $('#table').bootstrapTable('refresh',
                    {
                        query:{
                            bn:$('input[name=bn]').val(),
                            principal: $('input[name=principal]').val(),
                            offset: 0
                        }
                    }
                );
                $(this).one('click', searchFunc);
            });

            $('#saveForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ url()->current().'/save' }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data){
                        $.gritter.add({
                            title: '提示',
                            text: data.msg,
                            sticky: false,
                            time: 1000,
                            class_name: 'my-sticky-class'
                        });
                        $('.modal').modal('hide');
                        $('#table').bootstrapTable('refresh');
                    },
                    error: function(data){
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(name, value) {
                            $('#'+name).next('.error-span').text(value);
                            $('#'+name).parents('.form-group').addClass('has-error');
                        });
                    }
                });
            });
        });
    </script>
@endsection
