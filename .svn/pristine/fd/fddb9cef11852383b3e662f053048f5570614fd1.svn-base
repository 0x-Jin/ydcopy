<div class="modal-dialog" style="width: 1500px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工具管理>破损登记>添加破损</h4>
        </div>
        <div class="modal-body">
            <div class="main main-margin" style="border-top: none;">
                {!! Form::open(['url'=>'','class'=>'form-horizontal','id'=>'interviewForm']) !!}
                <input type='hidden' name='damage_id' value='{{$single->damage_id}}' />
                <input type='hidden' name='is_cod' id='is_cod' value='{{$single->is_cod}}' />
                <input type='hidden' name='cod_num' id='cod_num' value='{{$single->cod_num}}' />
                <input type='hidden' name='shipment_status' id='shipment_status' value='{{$single->shipment_status}}' />

                <div class="form-group">
                    <label for="title" class=" col-md-1">配货单:</label>
                        {{$single->shipment_id}}<input type="hidden" id="shipmentno" name="shipmentno" class="form-control" value='{{$single->shipment_id}}'   required="required"/>
                </div>

                <div class="form-group">
                    <label for="title" class=" col-md-1 ">配货单信息:</label>
                    <table id="maintable" class="table" style="width: 90%;">
                        @if($single)
                            <tr>
                                <th>店铺名称</th>
                                <th>交易号</th>
                                <th>客户姓名</th>
                                <th>电话</th>
                                <th>地址</th>
                                <th>快递公司</th>
                                <th>快递单号</th>
                                <th>是否货到付款</th>
                                <th>货到付款单号</th>
                            </tr>
                        @endif
                        <tr>
                            <td><input type='hidden' name='shopname'  class="form-control" value='{{$single->shopname}}'/>{{$single->shopname}}</td>
                            <td><input type='hidden' name='trade_id' class="form-control" value='{{$single->trade_id}}'/>{{$single->trade_id}}</td>
                            <td><input type='hidden' name='customer' class="form-control" value='{{$single->customer}}'/>{{$single->customer}}</td>
                            <td><input type='hidden' name='tellphone' class="form-control" value='{{$single->tellphone}}'/>{{$single->tellphone}}</td>
                            <td><input type='hidden' name='address' class="form-control" value='{{$single->address}}'/>{{$single->address}}</td>
                            <td><input type='hidden' name='delivery_company' class="form-control" value='{{$single->delivery_company}}'/>{{$single->delivery_company}}</td>
                            <td><input type='hidden' name='delivery_id' class="form-control" value='{{$single->delivery_id}}'/>{{$single->delivery_id}}</td>
                            <td><input type='hidden' name='is_cod' class="form-control" value='{{$single->is_cod}}'/>@if($single->is_cod)是@else否@endif</td>
                            <td><input type='hidden' name='cod_num' class="form-control" value='{{$single->cod_num}}'/>{{$single->cod_num}}</td>
                        </tr>
                    </table>
                </div>

                <div class="form-group">
                    <label for="title" class=" col-md-1 ">破损商品信息：</label>
                    <table id="detailtable" class="table" style="width: 90%;">
                        @if($detail)
                            <tr>
                                <th>商品编码*</th>
                                <th>规格编码*</th>
                                <th>商品名称*</th>
                                <th>数量*</th>
                                <th>销售单价*</th>
                                <th>有无实物返回*</th>
                                <th>原因*</th>
                                <th>责任方*</th>
                                <th style="width:85px;">操作</th>
                            </tr>
                        @endif
                    <!-- 初始化待更新的部分  update 作为标记 其他直接添加 -->
                        @foreach($detail as $k=>$good)
                            <tr>
                                <td><input name='good_bn[{{$good->item_id}}]' value='{{$good->good_bn}}' class="form-control"/></td>
                                <td><input name='spec_bn[{{$good->item_id}}]' value='{{$good->spec_bn}}' class="form-control"/></td>
                                <td><input name='good_name[{{$good->item_id}}]' value='{{$good->good_name}}' class="form-control"/></td>
                                <td><input name='number[{{$good->item_id}}]' value='{{$good->number}}' class="form-control"/></td>
                                <td><input name='sale_price[{{$good->item_id}}]' value='{{$good->sale_price}}' class="form-control"/></td>
                                <td>
                                    <select name='is_return[{{$good->item_id}}]' class="form-control">
                                        <option value=''>请选择</option>
                                        <option value='0' @if($good->is_return != 1)selected='selected'@endif >无实物返回</option>
                                        <option value='1' @if($good->is_return == 1)selected='selected'@endif >有实物返回</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="reason[{{$good->item_id}}]" class="form-control">
                                        <option value="">请选择原因</option>
                                        <option value="1" @if($good->reason == 1)selected='selected' @endif>快递运输途中破损</option>
                                        <option value="2" @if($good->reason == 2)selected='selected' @endif>快递运输途中丢件</option>
                                        <option value="3"  @if($good->reason == 3)selected='selected' @endif >仓库发货无物流信息</option>
                                        <option value="4"  @if($good->reason == 4)selected='selected' @endif>仓库错发</option>
                                        <option value="5"  @if($good->reason == 5)selected='selected' @endif>仓库少发</option>
                                        <option value="6"  @if($good->reason == 6)selected='selected' @endif>商品质量问题</option>
                                        <option value="7"  @if($good->reason == 7)selected='selected' @endif>运营问题</option>
                                        <option value="8"  @if($good->reason == 8)selected='selected' @endif>客服问题</option>
                                        <option value="9"  @if($good->reason == 9)selected='selected' @endif>其他(备注说明)</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="assumed_person[{{$good->item_id}}]" class="form-control">
                                        <option value="">请选择责任方</option>
                                        <option value="1" @if($good->assumed_person == 1)selected='selected' @endif>圆通</option>
                                        <option value="2" @if($good->assumed_person == 2)selected='selected' @endif>中通</option>
                                        <option value="3" @if($good->assumed_person == 3)selected='selected' @endif>京东</option>
                                        <option value="4" @if($good->assumed_person == 4)selected='selected' @endif>顺丰</option>
                                        <option value="5" @if($good->assumed_person == 5)selected='selected' @endif>客服</option>
                                        <option value="6" @if($good->assumed_person == 6)selected='selected' @endif>仓库</option>
                                        <option value="7" @if($good->assumed_person == 7)selected='selected' @endif>运营</option>
                                        <option value="8" @if($good->assumed_person == 8)selected='selected' @endif>公司</option>
                                    </select>
                                </td>
                                <td><span onclick='delrow(this);' class="btn btn-xs btn-warning btn-del" style="padding: 6px 3px;">删除</span>
                                    <span onclick='addrow(this);' class="btn btn-xs btn-info btn-edit" style="padding: 6px 3px;">添加</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="form-group">
                    <label for="title" class=" col-md-1 ">承担金额:</label>
                    <label for="title" class="control-label col-md-1">
                        <select class="form-control" name="assumed_ratio">
                            <option value="">请选择承担比例</option>
                            <option value="1" @if($single->assumed_ratio == 1)selected='selected'@endif >全额承担</option>
                            <option value="0" @if($single->assumed_ratio != 1)selected='selected'@endif>部分承担</option>
                        </select>
                    </label>
                    <label for="title" class="control-label col-md-1">
                        <input type="text" name="assumed_sum" id="shipmentno" class="form-control" value="{{$single->assumed_sum}}"   required="required"/>
                    </label>
                </div>

                <div class="form-group">
                    <label for="title" class=" col-md-1">备注说明:</label>
                    <label for="title" class="col-md-3">
                        <textarea class="form-control" id="comment" name="comment">{{$single->comment}}</textarea>
                    </label>
                </div>

                <div class="form-group">
                    <div for="title" class="modal-footer">
                        <button type='submit' class="btn btn-success btn-save">
                            提交
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">取消</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@section('js')
    @parent
<script>
    //保证每行数据都是对应的
    var cursor = {{$max}};

    /* function updateHTML(data){
     return console.log(data);
     var main = data.main;
     var detail = data.detail;

     var mainhtml = "<tr><th>店铺名称</th><th>交易号</th><th>客户姓名</th><th>电话</th><th>地址</th><th>快递公司</th><th>快递单号</th><th>货到付款</th><th>货到付款单号</th></tr>";

     mainhtml += "<tr>";

     mainhtml += "<td><input type='hidden' name='shopname' value='"+main[0].ShopName+"'/>"+main[0].ShopName+"</td>";

     mainhtml += "<td><input type='hidden' name='trade_id' value='"+main[0].TradeId+"'/>"+main[0].TradeId+"</td>";

     mainhtml += "<td><input type='hidden' name='customer' value='"+main[0].ConsigneeName+"'/>"+main[0].ConsigneeName+"</td>";


     mainhtml += "<td><input type='hidden' name='tellphone' value='"+main[0].ConsigneeTelephone+"'/>"+main[0].ConsigneeTelephone+"</td>";


     mainhtml += "<td><input type='hidden' name='address' value='"+main[0].ConsigneeAddress+"'/>"+main[0].ConsigneeAddress+"</td>";

     mainhtml += "<td><input type='hidden' name='delivery_company' value='"+main[0].ExpressNameActual+"'/>"+main[0].ExpressNameActual+"</td>";

     mainhtml += "<td><input type='hidden' name='delivery_id' value='"+main[0].ExpressNumber+"'/>"+main[0].ExpressNumber+"</td>";

     if(main[0].IsCod){main[0].IsCodName = '是';}else{main[0].IsCodName = '否';}
     mainhtml += "<td><input type='hidden' name='is_cod' value='"+main[0].IsCod+"'/>"+main[0].IsCodName+"</td>";

     mainhtml += "<td><input type='hidden' name='cod_num' value='"+main[0].CodNo+"'/>"+main[0].CodNo+"</td>";

     mainhtml += "</tr>";


     $('#is_cod').val(main[0].IsCod);
     $('#cod_num').val(main[0].CodNo);
     $('#shipment_status').val(main[0].DispatchStatus);

     $('#maintable').html(mainhtml);

     var detailhtml = '<tr><th>商品编码*</th><th>规格编码*</th><th>商品名称*</th><th>数量*</th><th>销售单价*</th><th>有无实物返回*</th><th>原因*</th><th>责任方*</th><th>操作</th></tr>';

     for(var single in detail){
     cursor++;
     detailhtml += "<tr>";
     detailhtml += "<td><input name='good_bn["+single+"]' value='"+detail[single].ProductCode+"'  /></td>";
     detailhtml += "<td><input name='spec_bn["+single+"]' value='"+detail[single].ProductSkuCode+"'/></td>";
     detailhtml += "<td><input name='good_name["+single+"]' value='"+detail[single].ProductName+"'/></td>";
     detailhtml += "<td><input  name='number["+single+"]' value='"+detail[single].DispatchQuantity+"'/></td>";
     detailhtml += "<td><input name='sale_price["+single+"]' value='"+detail[single].PriceSelling+"'/></td>";
     detailhtml += "<td><select name='is_return["+single+"]'><option value=''>请选择</option><option value='0'>无实物返回</option><option value='1'>有实物返回</option></select></td>";
     detailhtml += "<td><select name='reason["+single+"]'><option value=''>请选择原因</option><option value='1'>快递运输途中破损</option><option value='2'>快递运输途中丢件</option><option value='3'>仓库发货无物流信息</option><option value='4'>仓库错发</option><option value='5'>仓库少发</option><option value='6'>商品质量问题</option><option value='7'>运营问题</option><option value='8'>客服问题</option><option value='9'>其他(备注说明)</option></select></td>";
     detailhtml += "<td><select name='assumed_person["+single+"]'><option value=''>请选择责任方</option><option value='1'>圆通</option><option value='2'>中通</option><option value='3'>京东</option><option value='4'>顺丰</option><option value='5'>客服</option><option value='6'>仓库</option><option value='7'>运营</option><option value='8'>公司</option></select></td>";
     detailhtml += "<td><span onclick='delrow(this);'>删除</span>|<span onclick='addrow(this);'>添加</span></td></tr>";
     }
     $('#detailtable').html(detailhtml);
     }*/

    //添加一行数据操作：在当前行的下方加入：
    function addrow(obj){
        var html = '<tr>';
        html += '<td><input name="good_bn['+cursor+']"  class="form-control" id="goodsbn" required="required"/> <span class="error-span"></span></td>';
        html += '<td><input name="spec_bn['+cursor+']" class="form-control" id="spec_bn" required="required"> <span class="error-span"></span></td>';
        html += '<td><input name="good_name['+cursor+']" class="form-control" id="good_name" required="required"> <span class="error-span"></span></td>';
        html += '<td><input name="number['+cursor+']" class="form-control" id="number" required="required"> <span class="error-span"></span></td>';
        html += '<td><input name="sale_price['+cursor+']" class="form-control" id="sale_price" required="required"> <span class="error-span"></span></td>';
        html += '<td><select class="form-control" name="is_return['+cursor+']" id="is_return"><option value="">请选择</option><option value="0">无实物返回</option><option value="1">有实物返回</option></select> <span class="error-span"></span></td>';
        html += '<td><select class="form-control" name="reason['+cursor+']" id="reason"><option value="">请选择原因</option><option value="1">快递运输途中破损</option><option value="2">快递运输途中丢件</option><option value="3">仓库发货无物流信息</option><option value="4">仓库错发</option><option value="5">仓库少发</option><option value="6">商品质量问题</option><option value="7">运营问题</option><option value="8">客服问题</option><option value="9">其他(备注说明)</option></select> <span class="error-span"></span></td>';
        html += '<td><select class="form-control" name="assumed_person['+cursor+']" id="assumed_person"><option value="">请选择责任方</option><option value="1">圆通</option><option value="2">中通</option><option value="3">京东</option><option value="4">顺丰</option><option value="5">客服</option><option value="6">仓库</option><option value="7">运营</option><option value="8">公司</option></select> <span class="error-span"></span></td>';
        html += '<td><span onclick="delrow(this);" class="btn btn-xs btn-warning btn-del" style="padding: 6px 3px;margin-right:5px;">删除</span><span class="btn btn-xs btn-info btn-edit" style="padding: 6px 3px;" onclick="addrow(this);">添加</span></td></tr>';
        html += "</tr>";
        $(obj).parent().parent().after(html);
        cursor++;
    }
    //删除一行数据:
    function delrow(obj){
        $(obj).parent().parent().remove();
    }

    var import_url = '{{URL::route('damage.import')}}';

    //导入 点击触发
    $('#importbtn').click(function(){
        var no = $('#shipmentno').val();
        if(no == '') { alert('配货单号不能为空'); return; }

        $.ajax({
             type: "POST",
             url: import_url,
             data: {no:no,_token:index_ajax_token},
             dataType: "json",
             success: function(data){
                 if(data.status){//成功处理
                     updateHTML(data.data);
                 }else{//失败处理

                }
             }
         });
    });
    
    $('#interviewForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{URL::route('damage.doedit')}}',
            type: 'POST',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
                if(data.status == 1){
                    $.gritter.add({
                        title: '提示',
                        text: data.data,
                        sticky: false,
                        time: 1000,
                        class_name: 'my-sticky-class'
                    });
                    $('.modal').modal('hide');
                    window.location.reload();
                }else{
                    $.gritter.add({
                        title: '提示',
                        text: data.data,
                        sticky: false,
                        time: 1000,
                        class_name: 'my-sticky-class'
                    });
                }

            },

        });
    });


    /*$('#importbtn').click(function(){
     var no = $('#shipmentno').val();

     if(no == '') { alert('配货单号不能为空'); return; }

     $.ajax({
     type: "POST",
     url: import_url,
     data: {no:no,_token:index_ajax_token},
     dataType: "json",
     success: function(data){
     if(data.status){//成功处理
     updateHTML(data.data);
     }else{//失败处理

     }
     }
     });
     });*/

    //检验所有数据是否为空!!! 未检验!!

</script>





