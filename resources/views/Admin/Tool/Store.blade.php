@extends('Admin.Layouts.master')
@section('title', '批号库存查询')
@section('breadcrumb')
    <li>工具管理</li>
    <li class="active">批号库存查询</li>
@endsection

@section('errors')
    <div class="alert alert-danger hide">
        <ul>
        </ul>
    </div>
@endsection

@section('toolbar')
<div class="row form-inline form-ranking">
    <div class="form-group pull-right">
        <label class="control-label">item：</label>
        {{ Form::input('text', 'item', '', ['class'=>'form-control mr10', 'placeholder'=>'item', 'style'=>'width:150px;']) }}
        <label class="control-label">warehouse：</label>
        {{ Form::input('text', 'warehouse', 'c020', ['class'=>'form-control mr10', 'placeholder'=>'warehouse', 'style'=>'width:150px;']) }}
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

@section('js')
    @parent
    <script>
        $(function(){
            $('#table').bootstrapTable({
                url: g.current_path,
                method: 'post',
                queryParamsType: 'limit',
                queryParams: function(params){
                    params._token = g._token;
                    params.item = $('input[name=item]').val();
                    params.warehouse= $('input[name=warehouse]').val();
                    return params;
                },
                striped: true,
                uniqueId: 'id',
                pagination: true,
                sidePagination: 'server',
                onLoadSuccess: function(data){
                    $('.alert-danger').addClass('hide');
                },
                onLoadError: function(status, res){
                    $('.alert-danger').empty();
                    $.each(res.responseJSON, function(i, item){
                        $('.alert-danger').append('<li>'+i+':'+item+'</li>');
                    });
                    $('.alert-danger').removeClass('hide');
                },
                columns: [{
                    field: 'location_template',
                    title: 'location_template'
                }, {
                    field: 'item',
                    title: 'item'
                }, {
                    field: 'lot',
                    title: 'lot'
                }, {
                    field: 'ON_HAND_QTY',
                    title: 'ON_HAND_QTY'
                }, {
                    field: 'in_transit_qty',
                    title: 'in_transit_qty'
                }, {
                    field: 'allocated_qty',
                    title: 'allocated_qty'
                }, {
                    field: 'suspense_qty',
                    title: 'suspense_qty'
                }, {
                    field: 'aging_date',
                    title: 'aging_date'
                }, {
                    field: 'expiration_date',
                    title: 'expiration_date'
                }, {
                    field: 'received_date',
                    title: 'received_date'
                }, {
                    field: 'location',
                    title: 'location'
                }, {
                    field: 'item_desc',
                    title: 'item_desc'
                }]
            });

            $('.btn-search').one('click', searchFunc=function(){
                $('#table').bootstrapTable('refresh',
                    {
                        query:{
                            item:$('input[name=item]').val(),
                            warehouse: $('input[name=warehouse]').val(),
                            offset: 0
                        }
                    }
                );
                $(this).one('click', searchFunc);
            });
        });
    </script>


@endsection