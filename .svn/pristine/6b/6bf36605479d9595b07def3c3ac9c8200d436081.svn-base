@extends('Admin.Layouts.main')

@section('title', '投诉管理')
@section('breadcrumb')
    <li>管理</li>
    <li class="active">投诉管理</li>
@endsection
@section('inputs')
    <div class="form-group">
        <label class="control-label">{{ Config::get('self.select.consult.label') }}：</label>
        {{ Form::select('platform', Config::get('self.select.consult.opts'), old('platform'), ['class'=>'form-control','id'=>'form_platform', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>

    <div class="form-group">
        <label class="control-label">投诉时间：</label>
        {{ Form::input('text', 'mathStart', old('mathStart'), ['class'=>'form-control datepicker','id'=>'mathStart']) }}
        <span class="add-on control-label">至</span>
        {{ Form::input('text', 'mathEnd', old('mathEnd'), ['class'=>'form-control datepicker','id'=>'mathEnd']) }}
    </div>
    

    <div  class="form-group">
         <label class="control-label">{{ Config::get('self.select.consultsta.label') }}：</label>
        {{ Form::select('status', Config::get('self.select.consultsta.opts'), old('platForm'), ['class'=>'form-control','id'=>'status', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>

    <div  class="form-group">
         <label class="control-label">投诉标题：</label>
        {{ Form::input('text', 'title',old('title'),['class'=>'form-control','id'=>'title']) }}
    </div>
@endsection
@section('button')
        @parent
        <button type='button' class="btn btn-warning mr10" onclick="window.location.href='{{URL::route('tousu')}}'">
            <i class="fa"></i>&nbsp;入口
        </button>
@endsection
<script>
    
    var index_ajax_url = '{{URL::route('consult.post')}}';
    var index_ajax_token = '{{ csrf_token() }}';
    var edit_url = '{{URL::route('consult.edit')}}';
    var delete_url = '{{URL::route('consult.dele')}}';
    //定义要初始化的数据
    function init_form(){
        //所有表单初始化数据
        var form_data = {};
        form_data.platform = $('#form_platform').find("option:selected").val();
        form_data.mathStart = $('#mathStart').val();
        form_data.mathEnd = $('#mathEnd').val();
        form_data.status = $('#status').find("option:selected").val();
        form_data.title = $('#title').val();
        form_data._token = index_ajax_token;
        return form_data;
    }
    //提交
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
                "data":init_form()
             },
       }); 
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
                             @foreach($thead as $i =>$row)
                                <th>{{ $row }}</th>
                             @endforeach	
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

