<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>益丰电商管理系统 | 登陆</title>
    <!-- STYLESHEETS -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/flot/excanvas.min.js') }}"></script>
    <script src="{{ asset('assets/js/html5.js') }}"></script>
    <script src="{{ asset('assets/js/css3-mediaqueries.js') }}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cloud-admin.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <!-- DATE RANGE PICKER -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" />
    <!-- UNIFORM -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/uniform/css/uniform.default.min.css') }}" />
    <!-- ANIMATE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animatecss/animate.min.css') }}" />
    <!-- FONTS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css.css')}}?family=Open+Sans:300,400,600,700">

</head>
<body class="login">
<!-- PAGE -->
<!-- PAGE -->
<section id="page">
    <!-- HEADER -->
    <header>
        <!-- NAV-BAR -->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="logo">
                        <h1>益丰电商管理系统</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--/NAV-BAR -->
    </header>
    <!--/HEADER -->
    <!-- LOGIN -->
    <section id="login" class="visible">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-box-plain">
                        <div class="divide-40"></div>
                        <form role="form" method="POST" action="{{ url('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                <label for="username">账户名</label>
                                <i class="fa fa-envelope"></i>
                                <input type="type" class="form-control" id="username" name="username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">密码</label>
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-actions">
                                {{--<label class="checkbox"><input type="checkbox" class="uniform" name="remember">记住密码</label>--}}
                                <button type="submit" class="btn btn-danger">登 录</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/LOGIN -->
</section>
<!--/PAGE -->
<!-- JAVASCRIPTS -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JQUERY -->
<script src="{{ asset('assets/js/jquery/jquery-2.0.3.min.js') }}"></script>
<!-- JQUERY UI-->
<script src="{{ asset('assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<!-- BOOTSTRAP -->
<script src="{{ asset('assets/bootstrap-dist/js/bootstrap.min.js') }}"></script>
<!-- UNIFORM -->
<script type="text/javascript" src="{{ asset('assets/js/uniform/jquery.uniform.min.js') }}"></script>
<!-- CUSTOM SCRIPT -->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        App.setPage("login");  //Set current page
        App.init(); //Initialise plugins and elements
    });
</script>
<!-- /JAVASCRIPTS -->
</body>
</html>
