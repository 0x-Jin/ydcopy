<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>益丰电商管理系统 | 破损登记</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cloud-admin.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/default.css') }}" id="skin-switcher" >
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" >

        <!-- STYLESHEETS --><!--[if lt IE 9]>
        <script src="{{ asset('assets/js/flot/excanvas.min.js') }}"></script>
        <script src="{{ asset('assets/js/html5.js') }}"></script>
        <script src="{{ asset('assets/js/css3-mediaqueries.js') }}"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
        <!-- ANIMATE -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animatecss/animate.min.css') }}" />
        <!-- JQUERY UI-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css') }}" />
        <!-- SELECT -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select2/select2.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/gritter/css/jquery.gritter.css') }}" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset('assets/js/bootstrap-table/bootstrap-table.min.css') }}">
        <!-- FONTS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css.css')}}?family=Open+Sans:300,400,600,700">
        <!-- FileUplod -->
        <link rel="stylesheet" href="{{ asset('assets/js/jquery-upload/css/jquery.fileupload.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" />
    <body style="height:700px;overflow:hidden">
        <div class="modal-dialog" style="width:210mm;height:700px;overflow:hidden;margin: 2px auto;">
            <div class="modal-content">
                <div class="modal-body" style="padding:0 5px">
                    <div class="main" style="border-top: none;">
                        <div class="form-group" style="margin-bottom: 0px;font-weight: bold;">
                            <p style="padding-top:5px;font-size:20px;text-align: center;">益丰大药房B2C事业部证明</p>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="title" class=" col-md-1" style="width:13%;font-size:14px;">配货单:</label>
                            <label for="title" class="control-label col-md-3" style="padding:0 10px 0 0;">
                                {{$single->shipment_id}}
                            </label>
                        </div>
                        
                        <div >
                            <label for="title" class=" col-md-1" style="width:20%;font-size:14px;">配货单信息:</label>
                            <table id="maintable" class="table" style="margin-bottom: 5px;">
                                @if($single)
                                <tr>
                                    <th style="font-size: 12px;width:60px">店铺</th>
                                    <th style="font-size: 12px;width:55px">交易号</th>
                                    <th style="font-size: 12px;width:60px">姓名</th>
                                    <th style="font-size: 12px;width:45px">电话</th>
                                    <th style="font-size: 12px;">地址</th>
                                    <th style="font-size: 12px;width:40px">快递</th>
                                    <th style="font-size: 12px;width:45px">面单</th>
                                    <th style="font-size: 12px;width:45px">COD</th>
                                    <th style="font-size: 12px;width:70px">COD单号</th>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 5px;">{{$single->shopname}}</td>
                                    <td style="padding: 5px;">{{$single->trade_id}}</td>
                                    <td style="padding: 5px;">{{$single->customer}}</td>
                                    <td style="padding: 5px;">{{$single->tellphone}}</td>
                                    <td style="padding: 5px;">{{$single->address}}</td>
                                    <td style="padding: 5px;">{{$single->delivery_company}}</td>
                                    <td style="padding: 5px;">{{$single->delivery_id}}</td>
                                    <td style="padding: 5px;">@if($single->is_cod)是@else否@endif</td>
                                    <td style="padding: 5px;">{{$single->cod_num}}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="title" class=" col-md-1" style="width:20%;font-size:14px;">破损商品信息：</label>
                            <table id="detailtable" class="table" style="margin-bottom: 5px;">
                                <tr>
                                    <th style="font-size: 12px;width:80px">商品编码</th>
                                    <th style="font-size: 12px;width:70px">规格编码</th>
                                    <th style="font-size: 12px;">商品名称</th>
                                    <th style="font-size: 12px;width:40px">数量</th>
                                    <th style="font-size: 12px;width:70px">销售单价</th>
                                    <th style="font-size: 12px;width:70px">有无实物返回</th>
                                    <th style="font-size: 12px;width:60px">原因</th>
                                    <th style="font-size: 12px;width:40px">责任方</th>
                                </tr>
                                <!-- 初始化待更新的部分  update 作为标记 其他直接添加 -->
                                @foreach($detail as $k=>$good)
                                <tr>
                                    <td style="width:80px;padding: 5px;font-size: 12px;">{{$good->good_bn}}</td>
                                    <td style="padding: 5px;font-size: 12px;">{{$good->spec_bn}}</td>
                                    <td style="width:180px;padding: 5px;font-size: 12px;">{{$good->good_name}}</td>
                                    <td style="width:40px;padding: 5px;font-size: 12px;">{{$good->number}}</td>
                                    <td style="padding: 5px;font-size: 12px;">{{$good->sale_price}}元</td>
                                    <td style="width:70px;padding: 5px;font-size: 12px;">
                                        @if($good->is_return != 1)无实物返回@endif
                                        @if($good->is_return == 1)有实物返回@endif
                                    </td>
                                    <td style="width:60px;padding: 5px;font-size: 12px;">
                                        @if($good->reason == 1)快递运输途中破损@endif
                                        @if($good->reason == 2)快递运输途中丢件@endif
                                        @if($good->reason == 3)仓库发货无物流信息@endif
                                        @if($good->reason == 4)仓库错发 @endif
                                        @if($good->reason == 5)仓库少发@endif
                                        @if($good->reason == 6)商品质量问题@endif
                                        @if($good->reason == 7)运营问题@endif
                                        @if($good->reason == 8)客服问题@endif
                                        @if($good->reason == 9)其他(备注说明)@endif
                                    </td>
                                    <td style="width:40px;padding: 5px;font-size: 12px;">
                                        @if($good->assumed_person == 1)圆通@endif
                                        @if($good->assumed_person == 2)中通@endif
                                        @if($good->assumed_person == 3)京东@endif
                                        @if($good->assumed_person == 4)顺丰@endif
                                        @if($good->assumed_person == 5)客服@endif
                                        @if($good->assumed_person == 6)仓库@endif
                                        @if($good->assumed_person == 7)运营@endif
                                        @if($good->assumed_person == 8)公司@endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="title" class=" col-md-1" style="width:13%;font-size:14px;">承担金额:</label>
                            <label for="title" class="control-label col-md-1" style="width:11%;font-weight:normal">
                                @if($single->assumed_ratio == 1)全额承担@endif
                                @if($single->assumed_ratio != 1)部分承担@endif
                            </label>
                            <label for="title" class="control-label col-md-3" style="font-weight:normal">
                                {{$single->assumed_sum}}元
                            </label>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="title" class=" col-md-1" style="width:13%;font-size:14px;">备注说明:</label>
                            <label for="title" class="col-md-8" style="font-weight:normal">
                                {{$single->comment}}
                            </label>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="title" class=" col-md-1" style="width:12%;font-size:14px;">制单人:</label>
                            <label for="title" class="col-md-7" style="font-weight:normal">
                                {{$single->opeator}}
                            </label>
                            <label for="title" class=" col-md-1" style="width:13%;font-size:14px;">制单时间:</label>
                            <label for="title" class="col-md-2" style="font-weight:normal">
                                {{$single->opeator_time}}
                            </label>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>






