@extends('Admin.Layouts.master')
@section('title', '快递跟踪')
@section('breadcrumb')
    <li xmlns="http://www.w3.org/1999/html">工作管理</li>
    <li class="active">决策分析</li>
@endsection

@section('toolbar')
    <div class="row form-inline form-ranking">
        <div class="form-group">
            <a class="btn btn-warning btn-refresh mr10" href="javascript:;">
                <i class="fa fa-refresh"></i>&nbsp;刷新
            </a>
        </div>
    </div>
@endsection

@section('table')
    <div class="row col-md-12">
        <div class="row col-md-12">
            <div class="text-right mb10">
                商品总滞销参考：<span class="totalZhixiao">0</span>
            </div>
        </div>
        <div class="box">
            <table id="table"></table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal">
        <div class="modal-dialog" style="width: 1200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">库存信息</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(function(){

            $.post(
                '{{ url()->current().'/getTotalZhixiao' }}',
                { _token: g._token},
                function(data){
                    $('.totalZhixiao').text(data);
                }
            );

            $('.btn-refresh').one('click', refreshFunc = function(){
                $('#table').bootstrapTable('refresh');
                $(this).one('click', refreshFunc);
            }) ;

            var platForm = $.parseJSON('{!! json_encode(config("self.select.platForms0.opts")) !!}');

            $('#table').bootstrapTable({
                url: g.current_path,
                method: 'post',
                queryParamsType: 'limit',
                queryParams: function(params){
                    params._token = g._token;
                    return params;
                },
                striped: true,
                uniqueId: 'id',
                pagination: true,
                sidePagination: 'server',
                detailView: true,
                onExpandRow: function(index, row, $detail){
                    if(row.expand){
                        $detail.html(row.expand);
                        return $detail;
                    } else {
                        var skuids = [];
                        var tableDom  = '<table class="table table-striped table-bordered table-hover table-condensed">' +
                                '    <tr>' +
                                '        <td>skucode</td>' +
                                '        <td>名称</td>' +
                                '        <td>销售单价</td>' +
                                '        <td>折扣单价</td>' +
                                '        <td>数量</td>' +
                                '        <td>销售总金额</td>' +
                                '        <td>折扣</td>' +
                                '        <td>结算总金额</td>' +
                                '        <td>发货量</td>' +
                                '        <td>限制批发</td>' +
                                '        <td class="center">滞销参考</td>' +
                                '        <td></td>' +
                                '    </tr>';
                        $.each(row.order_detail, function(i, detail){
                            tableDom += '<tr>' +
                            '    <td>'+ detail.SkuCode+'</td>'+
                            '    <td>'+ detail.ProductName+'</td>'+
                            '    <td>'+ detail.PriceSelling+'</td>'+
                            '    <td>'+ detail.FirstCost+'</td>'+
                            '    <td>'+ detail.Quantity+'</td>'+
                            '    <td>'+ detail.Amount+'</td>'+
                            '    <td>'+ detail.DiscountAmount+'</td>'+
                            '    <td>'+ detail.AmountActual+'</td>'+
                            '    <td>'+ detail.DeliveryQuantity+'</td>'+
                            '    <td>'+ ( detail.isLimit ? '<span class="text-danger">限批发</span>' : '<span class="text-success">不限</span>' ) +'</td>'+
                            '    <td id='+detail.SkuCode+'>'+detail.SkuCode+'</td>'+
                            '    <td class="center">' +
                            '        <button data-skuid='+detail.SkuCode+' class="btn btn-xs btn-warning btn-store mr10">' +
                            '            <i class="fa fa-list"></i>库存查询' +
                            '        </button>' +
                            '     </td>' +
                            '</tr>';
                            skuids.push(detail.SkuCode);
                        });
                        tableDom += '</table>';

                        $.post(
                            g.current_path+'/getZhixiao',
                            {skuids: skuids, _token: g._token},
                            function(res){
                                $detail.html(tableDom);
                                $.each(res, function(i, val){
                                    $('#'+i, $detail).text(val);
                                });
                                row.expand = $detail.html();
                                return $detail;
                            }
                        );
                    }
                },
                columns: [{
                    field: 'order_main.TradeId',
                    title: '交易号'
                }, {
                    field: 'order_main.PlatformType',
                    title: '店铺',
                    formatter: function(val, row, index){
                        return platForm[val];
                    }
                }, {
                    field: 'order_main.Consignee',
                    title: '收货人'
                }, {
                    field: 'order_main.Quantity',
                    title: '数量'
                }, {
                    field: 'order_main.PayAmount',
                    title: '支付金额',
                    formatter: function (val, row, index) {
                        return parseFloat(val).toFixed(2);
                    }
                }, {
                    field: 'order_main.PayDate',
                    title: '支付时间'
                }, {
                    field: 'order_main.ConsigneeAddress',
                    title: '收货地址'
                }, {
                    field: 'order_main.DeliveryDate',
                    title: '发货时间'
                }, {
                    field: 'updated_at',
                    title: '最后修改时间',
                    formatter: function (val, row, index) {
                        var objDate = new Date(val * 1000);
                        var year    = objDate.getFullYear();
                        var month   = objDate.getMonth() + 1;
                        var day     = objDate.getDate();
                        var hour    = objDate.getHours();
                        var minute  = objDate.getMinutes();
                        var second  = objDate.getSeconds();

                        if( month < 10) month = '0' + month;
                        if( day < 10) day = '0' + day;
                        if( hour < 10) hour = '0' + hour;
                        if( minute < 10) minute = '0' + minute;
                        if( second < 10) second = '0' + second;
                        return year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
                    }
                }, {
                    field: 'status',
                    title: '状态',
                    formatter: function(val, row, index){
                        var text = [
                            '<span style="color:#808080">未操作</span>',
                            '<span class="text-danger">拒绝</span>',
                            '<span class="text-success">通过</span>'
                        ];
                        return text[row.status];
                    }
                }, {
                    class: 'col-xs-1',
                    align: 'center',
                    formatter: function(val, row, index){
                        domOp = '' +
                        '<button data-order_id='+row.order_id+' data-val="'+row.status+'" data-status="2" data-confirm="通过" class="btn btn-xs btn-success btn-confirm mr10">' +
                        '   <i class="fa fa-check-square-o"></i>通过' +
                        '</button>' +
                        '<button data-order_id='+row.order_id+' data-val="'+row.status+'" data-status="1" data-confirm="通过" class="btn btn-xs btn-danger btn-confirm mr10">' +
                        '   <i class="fa fa-times"></i>拒绝' +
                        '</button>';
                        return domOp;
                    }
                }]
            });

            $('#table tbody').on('click', '.btn-confirm', function(){
                if($(this).attr('data-val') > 0){
                    alert('已审核');
                    return;
                }
                var order_id = $(this).attr('data-order_id');
                var status = $(this).attr('data-status');
                var text = $(this).attr('data-confirm');

                bootbox.confirm("确定要"+text, function(result){
                    if(result){
                        $.post(
                            '{{ url()->current().'/change' }}',
                            { order_id: order_id, status: status, _token: g._token},
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

            $('#table tbody').on('click', '.btn-store', function(){
                $.post(g.current_path+'/getStore', {skuid: $(this).attr('data-skuid'), _token: g._token}, function(res){
                    var rightTal  =
                            '<table class="table table-striped table-bordered table-hover table-condensed">' +
                            '    <tr>' +
                            '        <td>location_template</td>' +
                            '        <td>批号</td>' +
                            '        <td>货架</td>' +
                            '        <td>on_hand_qty</td>' +
                            '        <td>in_transit_qty</td>' +
                            '        <td>allocated_qty</td>' +
                            '        <td>suspense_qty</td>' +
                            '        <td>aging_date</td>' +
                            '        <td>expiration_date</td>' +
                            '        <td>received_date</td>' +
                            '    </tr>';
                    $.each(res, function(i, row){
                        rightTal += '<tr>' +
                        '    <td>'+ row.location_template + '</td>' +
                        '    <td>'+ row.lot + '</td>' +
                        '    <td>'+ row.location + '</td>' +
                        '    <td>'+ parseFloat(row.ON_HAND_QTY).toFixed(2) + '</td>' +
                        '    <td>'+ parseFloat(row.in_transit_qty).toFixed(2) + '</td>' +
                        '    <td>'+ parseFloat(row.allocated_qty).toFixed(2) + '</td>' +
                        '    <td>'+ parseFloat(row.suspense_qty).toFixed(2) + '</td>' +
                        '    <td>'+ row.aging_date.substr(0, 19) + '</td>' +
                        '    <td>'+ row.expiration_date.substr(0, 19) + '</td>' +
                        '    <td>'+ row.received_date.substr(0, 19) + '</td>' +
                        '</tr>';
                    });
                    rightTal += '</table>';
                    $('.modal .modal-body').html(rightTal);
                    $('.modal').modal('show');
                });
            });

        });
    </script>
@endsection
