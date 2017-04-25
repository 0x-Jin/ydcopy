<div class="modal-dialog" style="width: 1080px;" >
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>任务编辑</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'taskmanage/doEdit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            <input type='hidden' name='task_id' value='{{$current['data']['task_id']}}' />
            <!--上几级结束-->
            @if($last)
            @foreach($last as $k=>$single)
            <div class="main" style="overflow:hidden;">
                <div class="form-group">
                    <label for="title" class="control-label col-md-1 col-md-title">@if($k == 0)发起人@else 接收人@endif</label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">@if($k == 0)期望时间@else 预计完成时间 @endif</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>
                <div class="form-group accordion-group">
                    <label for="title" class="control-label col-md-1 manage-arrow-down">↓</label>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">{{$single['data']['current_department']}}</span>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">  {{$single['data']['currentone']}} </span>
                    </div>
                    <span class="time-plug " style="text-align: center;">{{date('Y-m-d h-m',$single['data']['expire_time'])}}</span>
                    <span class="time-end " style="text-align: center;">{{date('Y-m-d h-m',$single['data']['op_time'])}}</span>
                </div>
                @if($k == 0)
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">标题</label>
                    <div class="col-md-7">
                        <span style="text-align: center;" >{{$mainData['title']}}</span>
                        <span class="error-span"></span>
                    </div>
                </div>
                @endif
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">描述</label>
                    <div class="col-md-7">
                        <span style="text-align: center;">{{$single['data']['remark']}}</span>
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">

                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">附件</label>
                    <div class="col-md-7">
                        @foreach($single['data']['addons'] as $v)
                        <span style="line-height: 45px;">
                            {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                        </span>
                        @endforeach
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!--上几级结束-->
            <!--当前级-->
            @if($current)
            <div class="main" style="overflow: hidden;">
                <div class="form-group">
                    <label for="title" class="control-label col-md-1 col-md-title">当前级</label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">预计完成时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>
                <div class="form-group" >
                    @if($current['data']['status']== 'on')
                    <label for="title" class="accordion-heading control-label col-md-1 manage-label-add">
                        <a id="open-info "  class=" manage-arrow-add accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            +
                        </a>
                    </label>
                    @else
                    <label for="title" class="accordion-heading control-label col-md-1 manage-arrow-down">↓</label>
                    @endif
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">{{$current['data']['current_department']}}</span>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">{{$current['data']['currentone']}}</span>
                    </div>
                    <input type='hidden' name='detail_task_id' value='{{$current['data']['detail_id']}}' />
                    @if($current['write'])
                    @if($current['data']['expire_time'])
                    {!! Form::text('current[expire_time]', date('Y-m-d h:m',$current['data']['expire_time']), ['class' => 'time-plug  form-control datepicker','check-type'=>'required']) !!}
                    @else
                    {!! Form::text('current[expire_time]', date('Y-m-d h:m',time()), ['class' => 'time-plug  form-control datepicker','check-type'=>'required']) !!}
                    @endif
                    @else
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        {{date('Y-m-d h:m',$current['data']['expire_time'])}}
                    </div>
                    @endif
                    @if($current['write'])
                    @if($current['data']['op_time'])
                    {!! Form::text('current[op_time]', date('Y-m-d h:m',$current['data']['op_time']), ['class' => 'time-plug form-control datepicker']) !!}
                    @else
                    {!! Form::text('current[op_time]', date('Y-m-d h:m',time()), ['class' => 'time-plug form-control datepicker']) !!}
                    @endif
                    @else
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        {{date('Y-m-d h:m',$current['data']['op_time'])}}
                    </div>
                    @endif
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">备注</label>
                    <div class="col-md-7">
                        @if($current['write'])
                        {!! Form::textarea('current[remark]', $current['data']['remark'], ['class' => 'form-control']) !!}
                        @else
                        <span style="text-align: center;">{{$current['data']['remark']}}</span>
                        @endif
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">附件</label>
                    <div class="col-md-7">
                        @if($current['write'])
                        <span class="btn btn-success fileinput-button" id='fileupload'>
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>上传附件</span>
                            <input type="file" name="files" multiple>
                        </span>
                        @endif
                        <table id='addons_list'>
                            @foreach($current['data']['addons'] as $v)
                            <tr>
                                <td>
                                    @if($current['write'])
                                    <input name='current[addons][]' type='hidden' value='{{$v}}'/>
                                    @endif
                                    {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">优先级</label>
                    <div class="col-md-7">
                        @if($current['write'])
                        {!! Form::text('current[rank]', $current['data']['rank'], ['class' => 'form-control,'checkform-type'=>'number','checkform-msg'=>'优先级只能为数字']) !!}
                        @else
                        <span style="text-align: center;"> {{$current['data']['rank']}}
                        </span>
                        @endif
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
            @endif
            <!---当前级结束-->
            <!--下一级-->
            @if($next)
            <div class="main" style="overflow: hidden;">
                <div class="form-group">
                    <label for="title" class="control-label col-md-1 col-md-title">下一级</label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">预计完成时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>
                <div class="form-group">
                    <label for="title" class="accordion-heading control-label col-md-1 manage-label-add">  </label>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">{{$next['data']['current_department']}}</span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span style="text-align: center;">{{$next['data']['currentone']}}</span>
                    </div>

                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        @if($current['data']['expire_time'])
                        {{date('Y-m-d h:m',$current['data']['expire_time'])}}
                        @endif
                    </div>

                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        @if($current['data']['op_time'])
                        {{date('Y-m-d h:m',$current['data']['op_time'])}}
                        @endif
                    </div>
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">备注</label>
                    <div class="col-md-7">
                        <span style="text-align: center;"> {{$next['data']['remark']}}</span>
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">附件</label>
                    <div class="col-md-7">
                        @foreach($next['data']['addons'] as $v)
                        <span  style="line-height: 45px;">
                            {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                        </span>
                        @endforeach
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2" />
                    <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">优先级</label>
                    <div class="col-md-7">

                        <span style="text-align: center;border: 0px;width: 100%;">{{$next['data']['rank']}}</span>

                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
            <!---下一级结束-->
            @else
            <!--- 当前状态还是进行  --->
            <div class="accordion-body collapse main mian-info" id="collapseTwo" >
                <div class="form-group">
                    <label for="title" class="control-label col-md-1  col-md-title">
                        下一级
                        <span id="close-info" class="manage-arrow-close">×</span></label>
                    <label for="title" class="control-label col-md-1 col-md-info" >部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >期望时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >操作日期</label>
                </div>
                <script>
                    function giveperson() {
                    var val = $("#getone").find("option:selected").val();
                    if (val == '') {
                    $('#worker').html('');
                    $('#worker').append("<option value=''>请选择部门</option>");
                    }
                    //请求部分
                    $.ajax({
                    type: "GET",
                            url: "getperson",
                            data: {did: val},
                            dataType: "html",
                            success: function (data) {
                            $('#worker').html('');
                            $('#worker').append(data);
                            }
                    });
                    }
                </script>
                <div class="form-group" >
                    <label for="title" class="control-label col-md-1 col-md-title"></label>
                    <div class="col-md-7" style="width: 20%;">
                        <select id="getone"  name="next[current_department]" class="form-control" onchange='giveperson()'>
                            <option value=''>请选择</option>
                            @foreach($alldepartment as $v)
                            <option value='{{$v->Department_id}}'>{{$v->Name}}</option>
                            @endforeach
                        </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="next[currentone]" class="form-control" id="worker">
                            <option value="">请选择人员</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if(!$next && $current['data']['status']== 'on')
        <div class="modal-footer" id='buttonall'>
            <button type="button" value="baocun" onclick='tosubmit(1)' class="btn btn-success btn-save" id="pass" name="save">保存</button>
            <button type="button" value="turn" onclick='tosubmit(2)'  class="btn btn-success btn-save" id="pass" name="turn">流转</button>
            <button type="button" value="wanjie" onclick='tosubmit(3)' class="btn btn-warning" id="finish" name="finished">完结</button>
        </div>
        @endif
        {!! Form::close() !!}
    </div>
</div>
<script src="{{ asset('assets/js/jquery-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/js/jquery-upload/js/jquery.fileupload.min.js') }}"></script>
<script>
      function tosubmit(num) {
        if (num == 1) {
            $('#interviewForm').append("<input type='hidden' name='save' value='save'/>");
            if (check($('#interviewForm'),true)) {
                $('#interviewForm').submit();
            }
        }
        if (num == 2) {
            $('#interviewForm').append("<input type='hidden' name='finished' value='finished'/>");
            if (check($('#interviewForm'),true)) {
                $('#interviewForm').submit();
            }
        }
        if (num == 3) {
            $('#interviewForm').append("<input type='hidden' name='turn' value='turn'/>");
            if (check($('#interviewForm'),false)) {
                $('#interviewForm').submit();
            }
        }
    }

    //由bool值决定是否检查
    function check(ele,bool) {
        var flag = 1;
        //找到所有的input,确定是否存在要验证的关键字，然后进行验证：
        ele.find('input[type=text]').each(function () {
            //假设
            if ($(this).attr("checkform-type") != '') {
                var val = $(this).val();
                var msg = $(this).attr("checkform-msg");
                var check_type = $(this).attr("checkform-type");
                switch (check_type) {
                    case 'tellphone':
                        if (!/^1[0-9]{10}$/.test(val)) {
                            flag = 0;
                            $(this).next().text(msg);
                            return false;
                        }
                        break;
                    case 'number':
                        if (!/[1-9]\d*/.test(val)) {
                            flag = 0;
                            $(this).next().text(msg);
                            return false;
                        }
                        break;
                    case 'date':
                        if (!/^\d{4}-\d{2}-\d{2}$/.test(val)) {
                            flag = 0;
                            $(this).next().text(msg);
                            return false;
                        }
                        break;
                    case 'required':
                        if (val == '') {
                            flag = 0;
                            $(this).next().text(msg);
                            return false;
                        }
                        break;
                }
            }
        });
        if (flag == 0)
            return false;
        ele.find('select').each(function () {
            if(bool){
                if ( $(this).attr("checkform-type") == 'required' && typeof($(this).attr("checkform-quick"))=="undefined" ) {
                    var msg = $(this).attr("checkform-msg");
                    if (!$(this).find('option:selected').val()) {            
                        alert($(this).find('option:selected').val());
                        flag = 0;
                        alert(msg);
                        return false;
                    }
                }
            }else{
               if ( $(this).attr("checkform-type") == 'required' && ) {
                    var msg = $(this).attr("checkform-msg");
                    if (!$(this).find('option:selected').val()) {           
                        alert($(this).find('option:selected').val());
                        flag = 0;
                        alert(msg);
                        return false;
                    }
                } 
            }
        });
        if (flag == 0)
            return false;
        return true;
    }

        $(function () {
                    $(".datepicker").datetimepicker({
                            format: "yyyy-mm-dd hh:ii"
                    });
                    @if ($current['write'])
                            //准备上传部分-
                            $("#fileupload").fileupload({
                    url: '{{URL::route('taskmanage.upload')}}',
                            formData:{_token:index_ajax_token},
                            sequentialUploads: true,
                            done: function (e, data) {
                            if (data.result.error || data.error) {
                            alert(data.result.msg);
                            } else{
                            $('#addons_list').append("<tr><td><input type='hidden' name='current[addons][]' value='" + data.result.short + "'>" + data.result.short + "</td></tr>");
                            }
                            }
                    });
                    @endif
                    });
                    $(function () {
                    $("#close-info").click(function () {
                    $(".mian-info").removeClass("in");
                    $(".mian-info").addClass("collapse");
                    if ($(".mian-info .collapse").is(":hidden")) {
                    $('.modal-body').find('#open-info').css('color', 'green')
                    } else{
                    $('.modal-body').find('#open-info').css('color', 'red')
                    }
                    })
                    });
</script>

