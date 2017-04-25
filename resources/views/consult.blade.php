<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>客户投诉部分</title>
        <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://www.uploadify.com/wp-content/themes/uploadify/style.css">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrapValidator.min.css')}}"/>
        <script src="http://kindeditor.net/ke4/kindeditor-all-min.js?t=20160331.js"></script>
        <script type="text/javascript" src="{{ asset('assets/uploadify/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/uploadify/jquery.uploadify.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrapValidator.min.js') }}"></script>
    </head>
    <body>

        <div class="container">
            <h4>客户投诉</h4> 
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach( array_unique($errors->all()) as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['url'=>'tsdo','class'=>'form-horizontal','id'=>'interviewForm']) !!}
            <div class="form-group">
                {!! Form::label('realname', '投诉人姓名:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('realname', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('platform','投诉平台:',['class'=>'col-sm-3 control-label'])  !!}
                <div class="col-sm-9">
                    <select name='platform'>
                        <option value='yhd'>一号店</option>
                        <option value='jd'>京东</option>  
                        <option value='tmall'>天猫</option>
                        <option value='yfdyf'>益丰大药房</option>
                        <option value='other'>其他</option>  
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title','投诉主题:',['class'=>'col-sm-3 control-label'])  !!}
                <div class="col-sm-9">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('body','投诉内容',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'editor_id']) !!}
                </div>
            </div>
            <div>
                <div  id='file_upload_1'>
                </div>
                <div id='images'>
                    
                </div>
                
            </div>
            <div class="form-group">
                {!! Form::label('tellphone', '联系手机:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('tellphone', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-mail:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('address', '联系地址:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9" id='allselect'>
                    {!! Form::hidden('proname', null,['id'=>'proname'] )!!}
                    {!! Form::hidden('cityname', null,['id'=>'cityname'] )!!}
                    {!! Form::hidden('areaname', null,['id'=>'areaname'] )!!}
                    <select name='pro'id='pro' class='select' onchange="toajax(this)">
                         <option value=''>请选择</option>
                        @foreach( $data as $v)
                           @foreach( $v as $kk=>$vv)
                           <option value='{{$kk}}'>{{$vv}}</option>
                           @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('comment', '备注:',['class'=>'col-sm-3 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group" style="text-align:center" >
                {!! Form::submit('提交', ['class' => 'btn btn-default','id'=>'pass']) !!}
            </div>  
            {!! Form::close() !!}
        </div>
    </body>
</html>
<script>
    //编辑器部分
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id',
        {
            items:[
                'source', '|', 'undo', 'redo', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|',
                 'table', 'hr', 'emoticons','pagebreak',
                'anchor', 'link', 'unlink', '|'
                ]
        }
        );
    });
    //上传组件部分
    $(function () {
        $("#file_upload_1").uploadify({
            height: 30,
            formData:{
		'_token':'{{ csrf_token() }}'
	    },
            swf: '{{ asset('assets/uploadify/uploadify.swf') }}',
            uploader: '{{URL::route('upload')}}',
            fileExt: '*.png;*.gif;*.jpg;*.bmp;*.jpeg',
            buttonText:'上传图片附件',
            width: 120,
            fileDesc: '图片文件(*.png;*.gif;*.jpg;*.bmp;*.jpeg)',  
            onUploadSuccess:function(file,data,response)   
            {
                var json = eval("("+data+")");//注意
                if(json.error){
                    alert(json.msg);
                    return;
                }else{
                  $("#images").append("<img src='"+json.msg+"'/><input type='hidden' name='images[]' value='"+json.msg+"' />");
                }
            },
            onError:function(event, queueID, fileObj)	//错误提示
            {
              alert(""+fileObj.name+"上传失败");
            }, 
        });
    });


    //ajax请求部分
    function toajax(obj){
        if($(obj).children('option:selected').val() == ''){
            $('#proname').val('');
            $('#cityname').val('');
            $('#areaname').val('');
            $(obj).nextAll().remove();return;//直接返回
        }
         $('#proname').val( $('.select').eq(0).children('option:selected').text() );//得到当前的 
         $('#cityname').val( $('.select').eq(1).children('option:selected').text());
         $('#areaname').val($('.select').eq(2).children('option:selected').text());
         //确定sid pid 以及 type
         var pid = $('.select').eq(0).children('option:selected').val();
         var sid = $('.select').eq(1).children('option:selected').val();
         var id = $(obj).attr('id');//
         var type = null;
         if(id == 'pro'){
             type = 'city';
         }else if(id == 'city'){
             type = 'area';
         }
         $.ajax({  //ajax请求
             type: "get",
             url: "address",
             data: {'pid':pid,'type':type,'sid':sid},
             dataType: "html",
             success: function(data){
                 $(obj).nextAll().remove(); //删除当前元素的所有同级元素后面的清空
                 $('#allselect').append(data);
             }
         });
    }
    
    //验证组件部分
    $(document).ready(function () {
        $('#interviewForm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            //要验证的字段：：
            fields: {
                'title': {
                    validators: {
                        notEmpty:{
                            message: '标题不能为空'
                        },
                        stringLength: {
                        min: 4,
                        max: 16,
                        message: '标题长度只能在 %s - %s 之间'
                        },
                    }
                },
                'realname': {
                    validators: {
                        notEmpty:{
                            message: '姓名不能为空'
                        },
                        stringLength: {
                        min: 2,
                        max: 4,
                        message: '姓名长度只能在 %s - %s 之间'
                        },
                    }
                },
                'body': {
                    validators: {
                        notEmpty:{
                            message: '内容不能为空'
                        },
                       stringLength: {
                        min: 6,
                        max: 30,
                        message: '填写长度请保持在%s - %s 之间'
                       },
                    }
                },
                'tellphone':{
                    validators:{
                        notEmpty:{
                            message: '电话号码不能为空'
                        },
                       regexp: {
                        regexp: /^1[0-9]{10}$/,
                        message: '电话号码错误'
                       },
                    }
                },
                'email':{
                    validators: {
                    notEmpty: {
                        message: 'email不能为空'
                    },
                    emailAddress: {
                        message: 'email地址不正确'
                    }
                   }
                },
                'comment':{
                    validators: {
                    notEmpty: {
                        message: '备注处理不能为空'
                    }
                   }
                },
            }
        });
    });
</script>
