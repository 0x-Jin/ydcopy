<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>益丰电商管理系统 | 天猫查询</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
</head>
<body>
    <section id="page">
        <div class="container">
            <div class="row" style="margin-top:75px;">
                <div id="content" class="col-lg-12">
                    <div class="row form-inline form-ranking">
                        <form action="{{ url()->current() }}" method="POST">
                            <div class="form-group pull-right">
                                <div class="form-group">
                                    <label class="control-label">{{ config('self.select.platForms1.label') }}：</label>
                                    {{ Form::select('platForm', array('益丰大药房旗舰店' => '益丰大药房旗舰店', '京东旗舰店' => '京东旗舰店',), old('platForm'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
                                </div>
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label class="control-label">时间：</label>
                                    {{ Form::input('text', 'startDate', old('startDate'), ['class'=>'form-control datepicker']) }}
                                    <?php
                                    $hourOpts = [];
                                    foreach(range(0, 23) as $val){
                                        $k = sprintf('%02d', $val);
                                        $hourOpts[$k] = $k;
                                    }
                                    ?>
                                    {{ Form::select('startHour', $hourOpts, old('startHour'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
                                    :00:00
                                    <span class="add-on control-label">至</span>
                                    {{ Form::input('text', 'endDate', old('endDate'), ['class'=>'form-control datepicker']) }}
                                    {{ Form::select('endHour', $hourOpts, old('endHour'), ['class'=>'form-control', 'tabindex'=>'-1', 'aria-hidden'=>'true']) }}
                                    :59:59
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
                            </div>
                        </form>
                    </div>

                    @if(isset($data))
                        <div class="row col-md-12">
                            <div class="text-right mb10">
                                @if($total == 0)
                                    未找到数据
                                @else
                                    共有 {{ $total }} 条数据， 最多显示1000条！查看详细请导出！
                                @endif
                            </div>
                        </div>
                        @if($l = count($data))
                            <div class="box-body">
                                <table id="table" data-toggle="table" data-striped="true">
                                    @foreach($data as $i =>$row)
                                        @if(is_array($row))
                                            @if($i == 0)
                                                <?php $keys = array_keys( (array)$row);?>
                                                <thead>
                                                <tr>
                                                    @foreach($keys as $key)
                                                        <th>{{ $key }}</th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                            @endif
                                            <tr>
                                                @foreach($keys as $key)
                                                    <td>{{ $row[$key] }}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    var g = {
        'current_path': '{{ url()->current() }}',
        'assets_path': '{{ asset('assets') }}'
    };
</script>
<!-- JAVASCRIPTS -->
<!-- JQUERY -->
<script src="{{ asset('assets/js/jquery/jquery-2.0.3.min.js') }}"></script>
<!-- JQUERY UI-->
<script src="{{ asset('assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<!-- BOOTSTRAP -->
<script src="{{ asset('assets/bootstrap-dist/js/bootstrap.min.js') }}"></script>
<!-- SLIMSCROLL -->
<script type="text/javascript" src="{{ asset('assets/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js') }}"></script>
<!-- BLOCK UI -->
<script type="text/javascript" src="{{ asset('assets/js/jQuery-BlockUI/jquery.blockUI.min.js') }}"></script>
<!-- SELECT -->
<script type="text/javascript" src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/gritter/js/jquery.gritter.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootbox/bootbox.js') }}"></script>
<!-- bootstrap TABLES -->
<script src="{{ asset('assets/js/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js') }}"></script>
<!-- COOKIE -->
<script type="text/javascript" src="{{ asset('assets/js/jQuery-Cookie/jquery.cookie.min.js') }}"></script>
<!-- CUSTOM SCRIPT -->
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        App.init(); //Initialise plugins and elements
    });
    bootbox.setDefaults('locale', 'zh_CN');

</script>
<!-- /JAVASCRIPTS -->
<script>
    g._token = $('meta[name="_token"]').attr('content');

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

</html>
