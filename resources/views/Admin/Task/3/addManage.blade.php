<!-- 添加任务页面 -->
<div class="modal-dialog" style="width: 1040px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>新增任务</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'taskmanage/doadd','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            <div class="form-group">
                <label for="title" class="control-label col-md-1 " style="line-height: 32px;">平台:</label>
                <label for="title" class="control-label col-md-1 " style="width: 80%">
                    <select name="platform" class="form-control">
                        <option value="yhd">一号店</option>
                        <option value="jd">京东</option>
                        <option value="tmall">天猫</option>
                        <option value="yfdyf">益丰大药房</option>
                        <option value="other">其他</option>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <label for="title" class="control-label col-md-1 " style="border: 0px;font-size: 16px;width: 10%;">发起人</label>
                <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
                <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
            </div>
            <div class="form-group">
                <label for="title" class="accordion-heading control-label col-md-1" style=" font-size: 60px;"> ↓ </label>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                    <span style="text-align: center;">{{$person['did']}}</span>
                    <span class="error-span"></span>
                </div>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                    <span style="text-align: center;">{{$person['pid']}}</span>
                </div>

                <div class="col-md-7" style="width: 20%;text-align: center;">
                    {!! Form::text('expire_time', null, ['class' => 'form-control datepicker']) !!}
                </div>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                    {!! Form::text('op_date', date('Y-m-d h:i',time()), ['class' => 'form-control datepicker']) !!}
                </div>
            </div>
            <div class="form-group " style="width: 89%;float: right;">
                <label for="title" class="control-label col-md-1 " style="border: 0">标题</label>
                <div class="col-md-7">
                    <span  style="line-height: 45px;">{!! Form::text('title', null, ['class' => 'form-control']) !!}</span>
                </div>
            </div>
            <div class="form-group " style="width: 89%;float: right;">
                <label for="title" class="control-label col-md-1 " style="border: 0">描述</label>
                <div class="col-md-7">
                    <span  style="line-height: 45px;">{!! Form::textarea('body', null, ['class' => 'form-control']) !!}</span>
                </div>
            </div>
            <div class="form-group " style="width: 89%;float: right;">
                <label for="title" class="control-label col-md-1 " style="border: 0">附件</label>
                <div class="col-md-7">
                    <span  id='fileupload' class="btn btn-success fileinput-button">
                         <i class="glyphicon glyphicon-plus"></i>
                                <span>上传附件</span>
                                <input type="file" name="files" multiple>
                    </span>
                    <table id='addons_list'>
                    </table>
                </div>
            </div>

            <div class="form-group" style="    width: 80%;">
                <label for="title" class="control-label col-md-1  col-md-title" style="border: 0px;">接收人</label>
                <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
                <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
            </div>

            <div class="form-group">
                <label for="title" class="accordion-heading control-label col-md-1" style="width: 10%;text-align: center;">  </label>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                   <span style="text-align: center;">
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
                                    <option value='{{$v->Department_Id}}'>{{$v->Name}}</option>
                                @endforeach
                            </select>
                    </span>
                    <span class="error-span"></span>
                </div>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                    <span style="text-align: center;">
                           <select name="worker" class="form-control" id="worker">
                               <option value="">请选择部门</option>
                           </select>
                    </span>
                </div>

                <div class="col-md-7" style="width: 10%;text-align: center;">
                    下一级填写
                </div>
                <div class="col-md-7" style="width: 20%;text-align: center;">
                    下一级填写
                </div>
            </div>
            <div class="form-group" >
                <div  style='text-align:center'>
                    {!! Form::submit('提交', ['class' => 'btn btn-success btn-save','id'=>'pass']) !!}
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
        $(".datepicker").datetimepicker({
            format: "yyyy-mm-dd hh:ii"
        });
    });

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



