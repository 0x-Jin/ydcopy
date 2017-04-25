@extends('Admin.Layouts.master')
@section('title', '店铺销售汇总')
@section('breadcrumb')
    <li>店铺</li>
    <li class="active">销售汇总</li>
@endsection

@section('toolbar')
<div class="row form-inline form-ranking">
    <form action="{{ url()->current() }}" method="POST">
    {{ csrf_field() }}
    <div class="plat-form">
        @include('Admin.Plat.inputs')
        <div class="form-group">
            <label class="control-label">{{ config('self.select.platForms1.label') }}：</label>
            {{ Form::select('platForm', config('self.select.platForms1.opts'), old('platForm'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
        </div>
        <div class="form-group">
            <label class="control-label">{{ config('self.select.orderType.label') }}：</label>
            {{ Form::select('orderType', config('self.select.orderType.opts'), old('orderType'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
        </div>
        <div class="form-group">
            <label class="checkbox inline">
                {{ Form::checkbox('isObSolete', 1, old('isObSolete')) }}包含取消交易订单
            </label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-search mr10" type="submit">
            <i class="fa fa-search"></i>&nbsp;查询
        </button>
        <a class="btn btn-warning btn-nocache mr10" data-url="{{ url()->current() }}?nocache=1" href="javascript:;">
            <i class="fa fa-refresh"></i>&nbsp;无缓存查询
        </a>
        <a class="btn btn-success btn-export mr10" href="javascript:alert('请先查询!');">
            <i class="fa fa-download"></i>&nbsp;导出
        </a>
    </div>
    </form>
</div>
@endsection

@section('js')
    @parent
    <script>
        $(function(){
            $('.btn-nocache').on('click', function(){
                $('form').attr('action', $(this).attr('data-url')).submit();
                return false;
            });

            @if(isset($file))
                $('.btn-export').attr('href', 'javascript:alert("excel正在生成，请稍候...");');
                $.get(
                        '{{ url()->current().'/export/'.$file }}',
                        function(res){
                            if(res.status){
                                $('.btn-export').attr('href', res.path);
                            } else {
                                alert(res.msg);
                            }
                        }
                );
            @endif
        });
    </script>
@endsection
