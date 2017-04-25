@extends('Common.Modal')
@section('title', "{$title}")
@section('content')
    <p>{{$message}}</p>
@endsection
<!-- 一般性消息在这里，3秒消失，缺点是写错了不会停留 -->

<script>
   setTimeout(function(){
          $('#modal').html();
          $('#modal').modal('hide');
          //转向新的地址
          window.location = '<?php echo $url; ?>';
   },3000);//也可以将停靠时间自定义
</script>

