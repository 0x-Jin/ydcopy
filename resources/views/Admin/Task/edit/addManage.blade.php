<!-- 添加任务页面 -->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>新增任务</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'taskmanage/doadd','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            平台:<select name="platform" class="form-control">
                <option value="yhd">一号店</option>
                <option value="jd">京东</option>
                <option value="tmall">天猫</option>
                <option value="yfdyf">益丰大药房</option>
                <option value="other">其他</option>
            </select>
            <div>
                <table class='table'>          
                    <tr>
                        <td rowspan="2">发起人</td>
                        <td>部门</td><td>员工</td><td>期望时间</td><td>操作日期</td>
                    </tr>
                    <tr>
                        
                        <td>{{$person['did']}}</td><td>{{$person['pid']}}</td>
                        
                        <td>{!! Form::text('expire_time', null, ['class' => 'form-control datepicker']) !!}</td>
                        <td>{!! Form::text('op_date', date('Y-m-d',time()), ['class' => 'form-control datepicker']) !!}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="3">详情</td>
                        <td>标题</td>
                        <td>{!! Form::text('title', null, ['class' => 'form-control']) !!}</td>
                    </tr>
                    <tr>
                        <td>描述</td>
                        <td>{!! Form::textarea('body', null, ['class' => 'form-control']) !!}</td>
                    </tr>
                    <tr>
                        <td>附件</td>
                        <td>
                            <span class="btn btn-success fileinput-button" id='fileupload'>
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>上传附件</span>
                                <input type="file" name="files" multiple>
                            </span>
                            
                            <table id='addons_list'>
                            </table>
                        </td>
                        
                    </tr>
                </table>
            </div>
            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="2">接收人</td>
                        <td>部门</td>
                        <td>员工</td>
                        <td>预计完成时间</td>
                        <td>操作时间</td>
                    </tr>
                    <tr>
                        <td>
                            <script>
                                 function giveperson(){
                                      var val =  $("#getone").find("option:selected").val(); 
                                      if(val == ''){
                                         $('#worker').html('');
                                         $('#worker').append("<option value=''>请选择部门</option>");
                                      }
                                      //请求部分
                                      $.ajax({
                                            type: "GET",
                                            url: "getperson",
                                            data: {did:val},
                                            dataType: "html",
                                            success: function(data){
                                                $('#worker').html('');
                                                $('#worker').append(data);
                                            }
                                      });
                                 }
                            </script>
                            <select id="getone" name="getone" class="form-control" onchange='giveperson()'>
                                <option value=''>请选择</option>
                                @foreach($department as $v)
                                   <option value='{{$v->Department_id}}'>{{$v->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                           <td>
                            <select name="worker" class="form-control" id="worker">
                                <option value="">请选择部门</option>
                            </select>
                           </td>
                           
                            
                        <td>下一级填写</td>
                        <td>下一级填写</td>
                    </tr>
                </table>
            </div>
            <div class="form-group" >
                <div  style='text-align:center'>
                      {!! Form::submit('提交', ['class' => 'btn btn-default','id'=>'pass']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/js/jquery-upload/js/jquery.fileupload.min.js') }}"></script>
<script>
    $(function(){
         $(".datepicker").datepicker();
    });

//    $(document).ready(function () {
//        $('#interviewForm').bootstrapValidator({
//            feedbackIcons: {
//                valid: 'glyphicon glyphicon-ok',
//                invalid: 'glyphicon glyphicon-remove',
//                validating: 'glyphicon glyphicon-refresh'
//            },
//            //要验证的字段：：
//            fields: {
//                'title': {
//                    validators: {
//                        notEmpty: {
//                            message: '标题不能为空'
//                        },
//                        stringLength: {
//                            min: 2,
//                            max: 4,
//                            message: '标题长度只能在 %s - %s 之间'
//                        },
//                    }
//                },
//                'realname': {
//                    validators: {
//                        notEmpty: {
//                            message: '姓名不能为空'
//                        },
//                        stringLength: {
//                            min: 2,
//                            max: 4,
//                            message: '姓名长度只能在 %s - %s 之间'
//                        },
//                    }
//                },
////                'body': {
////                    validators: {
////                        notEmpty:{
////                            message: '内容不能为空'
////                        },
////                       stringLength: {
////                        min: 6,
////                        max: 30,
////                        message: '填写长度请保持在%s - %s 之间'
////                       },
////                    }
////                },
////                'tellphone':{
////                    validators:{
////                        notEmpty:{
////                            message: '电话号码不能为空'
////                        },
////                       regexp: {
////                        regexp: /^1[0-9]{10}$/,
////                        message: '电话号码错误'
////                       },
////                    }
////                },
////                'email':{
////                    validators: {
////                    notEmpty: {
////                        message: 'email不能为空'
////                    },
////                    emailAddress: {
////                        message: 'email地址不正确'
////                    }
////                   }
////                },
////                'address':{
////                    validators: {
////                    notEmpty: {
////                        message: '地址不能为空'
////                    }
////                   }
////                },
////                'comment':{
////                    validators: {
////                    notEmpty: {
////                        message: '备注处理不能为空'
////                    }
////                   }
////                },
////                'check':{
////                    validators: {
////                    notEmpty: {
////                        message: '备注处理不能为空'
////                    }
////                   }
////                },
//            }
//        });
//    });
//    //放大效果
    
      $("#fileupload").fileupload({  
            url: '{{URL::route('taskmanage.upload')}}',  
            formData:{_token:index_ajax_token},
            sequentialUploads: true,
            done: function (e, data) {
                if(data.result.error){
                    alert(data.result.msg);
                }else{
                    $('#addons_list').append("<tr><td><input type='hidden' name='addons[]' value='"+data.result.short+"'>"+data.result.short+"<a href='downlist?name="+data.result.short+"'>下载</a></td></tr>");
                }
            }
      });

</script>



