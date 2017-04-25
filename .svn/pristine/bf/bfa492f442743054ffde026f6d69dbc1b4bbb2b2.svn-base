<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>益丰电商管理系统 | @yield('title')</title>
    @section('css')
        @include('Admin.Layouts.css')
    @show
</head>
<body>
    @section('header')
        @include('Admin.Layouts.header')
    @show
    <section id="page">
        @section('siderbar')
            @include('Admin.Layouts.siderbar')
        @show
        <div id="main-content">
            <div class="container">
                <div class="row">
                    <div id="content" class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-header">
                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="fa fa-home"></i>
                                            <a href="index.html">首页</a>
                                        </li>
                                        @yield('breadcrumb')
                                    </ul>
                                    @section('errors')
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach( array_unique($errors->all()) as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @show
                                </div>
                            </div>
                        </div>
                        @yield('toolbar')
                        @section('table')
                            @include('Admin.Layouts.table')
                        @show
                        <div class="footer-tools">
                            <span class="go-top">
                                <i class="fa fa-chevron-up"></i>回到顶部
                            </span>
                        </div>
                    </div>
                </div>
                @yield('modal')
            </div>
        </div>
    </section>
</body>
@section('js')
    <script>
        var g = {
            'current_path': '{{ url()->current() }}',
            'assets_path': '{{ asset('assets') }}'
        };
    </script>
    @include('Admin.Layouts.js')
    <script>
        g._token = $('meta[name="_token"]').attr('content');
    </script>
@show
</html>