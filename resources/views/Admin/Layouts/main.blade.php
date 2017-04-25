<!DOCTYPE html>
<html>
    <head>
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
        <!-- PAGE -->
        <section id="page">
            @section('siderbar')
            @include('Admin.Layouts.siderbar')
            @show
            <div id="main-content">
                <!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Box Settings</h4>
                            </div>
                            <div class="modal-body">
                                Here goes box setting content.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
                <div class="container">
                    <div class="row">
                        <div id="content" class="col-lg-12">
                            <!-- PAGE HEADER-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-header">
                                        <!-- BREADCRUMBS -->
                                        <ul class="breadcrumb">
                                            <li>
                                                <i class="fa fa-home"></i>
                                                <a href="index.html">首页</a>
                                            </li>
                                            @yield('breadcrumb')
                                        </ul>
                                        <!-- /BREADCRUMBS -->

                                        @yield('intro')
                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach( array_unique($errors->all()) as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /PAGE HEADER -->
                            <!-- FILTER -->
                            <div class="row">
                                {{ Form::open(['route'=>Route::currentRouteName(), 'class'=>'form-inline form-ranking', 'role'=>'form']) }}
                                @yield('inputs')
                                {{ Form::token() }}
                                @section('button')
                                <button class="btn btn-primary btn-search mr10" type="button" onclick='post_form()'>
                                    <i class="fa fa-search"></i>&nbsp;查询
                                </button>
                                @show
                                {{ Form::close() }}
                            </div>
                            <!-- /FILTER -->
                            @section('table')
                            @include('Admin.Layouts.table', ['table' => isset($table) ? $table : []])
                            @show
                            <!-- GO TOP -->
                            <div class="footer-tools">
                                <span class="go-top">
                                    <i class="fa fa-chevron-up"></i>回到顶部
                                </span>
                            </div>
                            <!-- /GO TOP -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="modal"  class="modal fade container"></div>
        <!--  关键删除代码，千万不要去掉   -->
        <div id="deleteshow" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">确定要删除吗?</h4>
                    </div>
                    <div class="modal-body">
                        <button data-bb-handler="cancel" data-dismiss="modal" type="button" class="btn btn-default">取消</button>
                        <button data-bb-handler="confirm" id="delete_button" onclick="delete_sure()"  type="button" class="btn btn-primary">确定</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/PAGE -->
    </body>
    @section('js')
    @include('Admin.Layouts.jsother')
    @show
</html>
