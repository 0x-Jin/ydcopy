@extends('Admin.Layouts.master')
@section('title', '销售商品订单批号查询')
@section('breadcrumb')
    <li>工具管理</li>
    <li class="active">销售商品订单批号查询</li>
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
        {{ Form::input('text', 'item', '', ['class'=>'form-control mr10', 'placeholder'=>'item']) }}
        <label class="control-label">shipment_id：</label>
        {{ Form::input('text', 'shipment_id', '', ['class'=>'form-control mr10', 'placeholder'=>'shipment_id', 'style'=>'width:175px;']) }}
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
                    params.shipment_id= $('input[name=shipment_id]').val();
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
                    field: 'item',
                    title: 'item'
                }, {
                    field: 'item_desc',
                    title: 'item_desc'
                }, {
                    field: 'allocated_qty',
                    title: 'allocated_qty'
                }, {
                    field: 'lot',
                    title: 'lot'
                }, {
                    field: 'allocation_zone',
                    title: 'allocation_zone'
                }, {
                    field: 'item_list_price',
                    title: 'item_list_price'
                }, {
                    field: '波次号',
                    title: '波次号'
                }, {
                    field: 'requested_qty',
                    title: 'requested_qty'
                }, {
                    field: 'from_loc',
                    title: 'from_loc'
                }, {
                    field: 'to_loc',
                    title: 'to_loc'
                }, {
                    field: 'from_work_zone',
                    title: 'from_work_zone'
                }, {
                    field: 'to_work_zone',
                    title: 'to_work_zone'
                }, {
                    field: 'user_def2',
                    title: 'user_def2'
                }]
            });

            $('.btn-search').one('click', searchFunc=function(){
                $('#table').bootstrapTable('refresh',
                    {
                        query:{
                            item:$('input[name=item]').val(),
                            shipment_id: $('input[name=shipment_id]').val(),
                            offset: 0
                        }
                    }
                );
                $(this).one('click', searchFunc);
            });
        });
    </script>
@endsection
