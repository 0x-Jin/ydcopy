@extends('Admin.Layouts.master')
@section('title', '商品回购分析')
@section('breadcrumb')
    <li>会员报表</li>
    <li class="active">回购分析</li>
@endsection

@section('intro')
<div class="clearfix">
    <h3 class="content-title pull-left">商品回购分析</h3>
</div>
<div class="description">
    <p>--查询条件：店铺、商品规格码、订单时间</p>
    <p>--列名：店铺、商品规格码、平均第一回购周期、第一回购周期峰值、第二回购周期峰值、第一回购周期峰值占比</p>
    <p>--平均第一回购周：订单时间内，第一次与第二次购买的时间差总平均值；</p>
    <p>--第一回购周期峰值：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比最多的值；</p>
    <p>--第一回购周期峰值：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比第二多的值；</p>
    <p>--第二回购周期峰值：订单时间内，第二次购买与第三次购买的时间差的集合中，天数占比最多的值；</p>
    <p>--第一回购周期峰值占比：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比最多的值的会员个数/订单时间内有第二次购买的（去重）会员总数；</p>
    <p>--作用：是为了用来筛选商品回购周期，从而为会员营销提供数据参考，做好会员短信精准营销，从而提高复购率。</p>
</div>
@endsection

@section('toolbar')
<div class="row form-inline form-ranking">
    <form action="{{ url()->current() }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="control-label">订单时间：</label>
        {{ Form::input('text', 'orderStart', old('orderStart'), ['class'=>'form-control datepicker']) }}
        <span class="add-on control-label">至</span>
        {{ Form::input('text', 'orderEnd', old('orderEnd'), ['class'=>'form-control datepicker']) }}
    </div>
    <div class="form-group">
        <label class="control-label">{{ config('self.select.platForms1.label') }}：</label>
        {{ Form::select('platForm', config('self.select.platForms1.opts'), old('platForm'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
    </div>
    <div class="form-group">
        <label class="control-label">商品规格码：</label>
        {{ Form::input('text', 'skuCode', old('skuCode'), ['class'=>'form-control']) }}
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
