@extends('Admin.Layouts.main')
@section('title', '破损登记')
@section('breadcrumb')
    <li>工具管理</li>
    <li class="active">破损登记</li>
@endsection
@section('inputs')
    <div class="form-group">
        <label class="control-label">{{ Config::get('self.select.consult.label') }}：</label>
        {{ Form::select('platform', Config::get('self.select.damageshopname.opts'), old('platform'), ['class'=>'form-control','id'=>'form_platform', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>

    <div  class="form-group">
        {{ Form::select('reason', Config::get('self.select.damagereason.opts'), old('platForm'), ['class'=>'form-control','id'=>'reason', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>

    <div  class="form-group">
       {{ Form::select('person', Config::get('self.select.damageperson.opts'), old('platForm'), ['class'=>'form-control','id'=>'person', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>

    <div  class="form-group">
        {{ Form::input('bn', 'bn',old('bn'),['class'=>'form-control','id'=>'bn','placeholder'=>"请输入规格编码查询"]) }}
    </div>

    <div  class="form-group">
        {{ Form::input('shipment_id', 'shipment_id',old('shipment_id'),['class'=>'form-control','id'=>'shipment_id','placeholder'=>"请输入配货单号"]) }}
    </div>

    <div class="form-group">
        {{ Form::input('text', 'mathStart', old('mathStart'), ['class'=>'form-control datepicker','id'=>'mathStart']) }}
        <span class="add-on control-label">至</span>
        {{ Form::input('text', 'mathEnd', old('mathEnd'), ['class'=>'form-control datepicker','id'=>'mathEnd']) }}
    </div>
@endsection
@section('button')
        @parent
        <button type='button' class="btn btn-warning mr10" onclick="exportall()">
            <i class="fa"></i>&nbsp;导出
        </button>
        <button type='button' class="btn btn-warning mr10" onclick="add_page()">
            <i class="fa"></i>&nbsp;添加
        </button>
@endsection
<script>
    //定义变量    
    var index_ajax_url = '{{URL::route('damage.post')}}';
    var index_ajax_token = '{{ csrf_token() }}';
    var edit_url = '{{URL::route('damage.edit')}}';
    var delete_url = '{{URL::route('damage.dele')}}';
    var add_url = '{{URL::route('damage.add')}}';
    //定义要初始化提交的数据 会传递到scriptother.js 中去：所有初始化内容全部在scriptother中设置： 文档参考 http://datatables.club/reference/option/
    function init_form(){
        var form_data = {};
        form_data.platform = $('#form_platform').find("option:selected").val();
        form_data.mathStart = $('#mathStart').val();
        form_data.mathEnd = $('#mathEnd').val();
        form_data.reason = $('#reason').find("option:selected").val();
        form_data.person = $('#person').find("option:selected").val();
        form_data.bn = $('#bn').val();
        form_data.shipment_id = $('#shipment_id').val();
        form_data._token = index_ajax_token;
        return form_data;
    }
    
    function post_form(){
        $('#datatable1').DataTable({//有用代码
            'language': {  
                'emptyTable': '没有数据',  
                'loadingRecords': '加载中...',  
                'processing': '查询中...',  
                'search': '检索:',  
                'lengthMenu': '每页 _MENU_ 条',  
                'zeroRecords': '没有数据',  
                'paginate': {  
                    'first':      '第一页',  
                    'last':       '最后一页',  
                    'next':       '>>',  
                    'previous':   '<<'  
                },  
                'info': '第 _PAGE_ 页 / 总 _PAGES_ 页',  
                'infoEmpty': '没有数据',  
                'infoFiltered': '(过滤总件数 _MAX_ 条)'  
            },
            "processing": true,
            "serverSide": true,
            "destroy": true,
            ajax: {
               "url": index_ajax_url,
               "type": 'post',
               //"columnDefs": [{"targets": 0,"data": null,"defaultContent": "<button>Select Image ID</button>"} ],
               "data":init_form()
             }
       }); 
    };
    
    function exportall(){
         var url = "{{URL::route('damage.export')}}?";
         var data = init_form();
         for(var i in data){
            if (data[i] != "undefined") { url += i+"="+data[i]+"&"};
         }
        location.href = url;
    }
</script>
@section('table')
<!-- DATA TABLES -->
<div class="row">
    <div class="col-md-12">
        <!-- BOX -->
        <div class="box border">
            <div class="box-title">
                <h4><i class="fa fa-table"></i>@yield('title')表</h4>
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
                <table id="datatable1" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover" style=" font-size: 13px;">
                    <thead>
                            <tr>
                                <th width="9%">ShopName</th>
                             	<th width="9%">配货单号</th>
                                <th width="4%">姓名</th>
                                <th width="4%">电话</th>
                                <th width="8%">快递单号</th>
                                <th width="3%">快递</th>
                                <th width="13%">说明</th>
                                <th width="5%">承担比例</th>
                                <th width="3%">金额</th>
                                <th width="6%">制单时间</th>
                                <th width="4%">制单人</th>
                                <th width="5%">配货状态</th>
                                <th width="1%">COD</th>
                                <th width="8%">COD单号</th>
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

@section('js')
    @parent
    @include('Admin.Layouts.myui')
@endsection



