@extends('Admin.Layouts.master')
@section('title', '快递跟踪')
@section('breadcrumb')
    <li>工作管理</li>
    <li class="active">客服日志</li>
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
            <label class="control-label">标题：</label>
            {{ Form::input('text', 'title', '', ['class'=>'form-control mr10', 'placeholder'=>'标题']) }}
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
                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::hidden('id', null) }}
                            {{ Form::label('title', '标题', ['class'=>'control-label col-md-1']) }}
                            <div class="col-md-7">
                                {{ Form::text('title', null, ['class'=>"form-control"]) }}
                                <span class="error-span"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', '描述', ['class'=>'control-label col-md-1']) }}
                            <div class="col-md-7">
                                {{ Form::textarea('description', null, ['class'=>"form-control", 'style'=>"width:800px;height:300px;visibility:hidden;"]) }}
                                <span class="error-span"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', '类型', ['class'=>'control-label col-md-1']) }}
                            <div class="col-md-7">
                                {{ Form::select('type', ['商品问题', '退货问题', '发货问题', '其他问题'], '', ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
                                <span class="error-span"></span>
                            </div>
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
    <script charset="utf-8" src="{{ asset('assets/js/kindeditor/kindeditor-all-min.js') }}"></script>
    <script charset="utf-8" src="{{ asset('assets/js/kindeditor/lang/zh-CN.js') }}"></script>
    <script>
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="description"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons']
            });
            prettyPrint();
        });

        $(function(){
            $('.btn-refresh').one('click', refreshFunc = function(){
                $('#table').bootstrapTable('refresh');
                $(this).one('click', refreshFunc);
            });

            $('.btn-add').one('click', addFunc = function(){
                $('#saveForm input:not([name=_token])').val('');
                $('#saveForm').get(0).reset();
                editor.html('');
                $('.modal').modal('show');
                $(this).one('click', addFunc);
            });

            $('#table').bootstrapTable({
                url: g.current_path,
                method: 'post',
                queryParamsType: 'limit',
                queryParams: function(params){
                    params._token = g._token;
                    params.title = $('input[name=title]').val();
                    return params;
                },
                striped: true,
                uniqueId: 'id',
                pagination: true,
                sidePagination: 'server',
                detailView: true,
                onExpandRow: function(index, row, $detail){
                    return $detail.html(row.description);
                },
                columns: [{
                    field: 'id',
                    title: 'id'
                }, {
                    field: 'title',
                    title: '标题'
                }, {
                    field: 'author',
                    title: '作者'
                }, {
                    field: 'type',
                    title: '类型',
                    formatter: function(val, row, index){
                        var selectText = ['商品问题', '退货问题', '发货问题', '其他问题'];
                        return selectText[val];
                    }
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
                    if(name == 'description'){
                        editor.html(v);
                        return;
                    }
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
                $('#description').val(editor.html());

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
