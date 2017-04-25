@extends('Admin.Layouts.master')
@section('title', '取消配货单')
@section('breadcrumb')
    <li>工具管理</li>
    <li class="active">取消配货单</li>
@endsection

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

    @if(isset($status) && $status == 0)
        <div class="alert alert-danger">
            <ul>
                <li>配货单：{{$shipment_id}}，{{ $msg }}</li>
            </ul>
        </div>
    @elseif(isset($status) && $status == 1)
        <div class="alert alert-success">
            <ul>
                <li>配货单：{{$shipment_id}}，{{ $msg }}</li>
            </ul>
        </div>
    @endif
@endsection

@section('toolbar')
<div class="row form-inline form-ranking">
    <div class="form-group pull-right">
        <form action="{{ url()->current() }}" method="POST">
            {{ csrf_field() }}
            <label class="control-label">单号：</label>
            {{ Form::input('text', 'shipment_id', old('isObSolete'), ['class'=>'form-control mr10', 'style'=>'width:200px;']) }}
            <button class="btn btn-primary btn-search mr10" type="submit">
                <i class="fa fa-remove"></i>&nbsp;取消
            </button>
        </form>
    </div>
</div>
@endsection

