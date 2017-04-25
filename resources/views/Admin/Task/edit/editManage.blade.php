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
                        <label for="title" class="control-label col-md-1 col-md-title">发起人</label>
                        <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                        <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                        <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
                        <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                    </div>
                    <div class="form-group accordion-group">
                        <label for="title" class="control-label col-md-1 manage-arrow-down">↓</label>
                        <div class="col-md-7" style="width: 20%;text-align: center;">
                            <span style="text-align: center;">  {{$single['data']['current_department']}} </span>
                            <span class="error-span"></span>
                        </div>
                        <div class="col-md-7" style="width: 20%;text-align: center;">
                            <span style="text-align: center;">  {{$single['data']['currentone']}} </span>
                        </div>
                        <span class="time-plug " style="text-align: center;">{{date('Y-m-d h-m-s',$single['data']['expire_time'])}}</span>
                        <span class="time-end " style="text-align: center;">{{date('Y-m-d h-m-s',$single['data']['op_time'])}}</span>
                    </div>
                    <div class="form-group form-width">
                        <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">描述</label>
                        <div class="col-md-7">
                            <span style="text-align: center;"id="title" >{{$single['data']['remark']}}</span>
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
                    <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
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
                        {!! Form::text('current[expire_time]', date('Y-m-d',$current['data']['expire_time']), ['class' => 'time-plug  form-control datepicker']) !!}
                        @else
                        {!! Form::text('current[expire_time]', date('Y-m-d',time()), ['class' => 'time-plug  form-control datepicker']) !!}
                    @endif
                    @else
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        {{date('Y-m-d',$current['data']['expire_time'])}}
                    </div>
                    @endif


                    @if($current['write'])
                        @if($current['data']['op_time'])
                        {!! Form::text('current[op_time]', date('Y-m-d',$current['data']['op_time']), ['class' => 'time-plug form-control datepicker']) !!}
                        @else
                        {!! Form::text('current[op_time]', date('Y-m-d',time()), ['class' => 'time-plug form-control datepicker']) !!}
                        @endif
                    @else
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        {{date('Y-m-d',$current['data']['op_time'])}}
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
                           {!! Form::text('current[rank]', $current['data']['rank'], ['class' => 'form-control']) !!}
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
                    <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
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
                        {!! Form::text('next[expire_time]', date('Y-m-d',$current['data']['expire_time']), ['class' => 'time-plug  form-control datepicker']) !!}
                        @endif
                    </div>

                    <div class="col-md-7" style="width: 20%;text-align: center;">
                         @if($current['data']['op_time'])
                        {!! Form::text('next[expire_time]', date('Y-m-d',$current['data']['op_time']), ['class' => 'time-plug  form-control datepicker']) !!}
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
            @if($current['data']['status']== 'on')
                <button type='button' onclick='hide()' id='add_turn' class="btn btn-success btn-save">添加流转</button></td>
            @endif
            
            <div style='display: none' id='turn_next'>
                <table class='table'>
                    <tr>
                        <td rowspan="2">下一级</td>
                        <td>部门</td>
                        <td>员工</td>
                        <td>预计完成时间</td>
                        <td>操作时间</td>
                    </tr>

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
                    <tr>
                        <td>
                            <select id="getone" name="next[current_department]" class="form-control" onchange='giveperson()'>
                                <option value=''>请选择</option>
                                @foreach($alldepartment as $v)
                                <option value='{{$v->Department_id}}'>{{$v->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="next[currentone]" class="form-control" id="worker">
                                <option value="">请选择部门</option>
                            </select>
                        </td>
                        <td>下一级填写</td>
                        <td>下一级填写</td>
                    </tr>
                </table>
            </div>
            @endif
            @if(!$next && $current['data']['status']== 'on')
                    <div class="modal-footer" id='buttonall'>
                        <button type="submit" value="baocun" class="btn btn-success btn-save" id="pass" name="save">保存</button>
                        <button type="submit" value="wanjie" class="btn btn-warning" id="finish" name="finished">完结</button>
                    </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/js/jquery-upload/js/jquery.fileupload.min.js') }}"></script>
<script>
        $(function () {
            $(".datepicker").datepicker();
            @if ($current['write'])
                    //准备上传部分-
                    $("#fileupload").fileupload({
            url: '{{URL::route('taskmanage.upload')}}',
                    formData:{_token:index_ajax_token},
                    sequentialUploads: true,
                    done: function (e, data) {
                    if (data.result.error || data.error) {
                    alert(data.result.msg);
                    } else {
                    $('#addons_list').append("<tr><td><input type='hidden' name='current[addons][]' value='" + data.result.short + "'>" + data.result.short + "</td></tr>");
                    }
                    }
            });
            @endif
        });
        function hide() {
            $('#finish').remove();
            //添加下一级内容以及控制按钮,添加流转
            $('#buttonall').append("<input class='btn btn-default' type='submit' value='流转到下一个' name='turn' />");
            var reBtn = $("<input class='btn btn-default' type='button' value='返回' name='return' />");
            $('#buttonall').append(reBtn);
            reBtn.click(
                    function(){
                    $('#buttonall').append($('#finish'));
                    $('#turn_next').hide();
                    $('#add_turn').show();
                    $(this).hide();
                    }
            );
            //添加下一个的部分代码
            $('#turn_next').show(); //展示下一个：
            $('#add_turn').hide(); //如何删除流转
        }
</script>

