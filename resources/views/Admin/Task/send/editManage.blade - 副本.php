<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>任务编辑</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'taskmanage/doEdit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            <!-- 指示当前修改的节点信息  -->
            <input type='hidden' name='detail_task_id' value='{{$current['data']['detail_id']}}' />
            <input type='hidden' name='task_id' value='{{$current['data']['task_id']}}' />
            <!--  第一个级别开始，不能修改 --->
            @if($last)
            @foreach($last as $k=>$single)
            <div>
                <table class='table'>          
                    <tr>
                        <td rowspan="2">
                           @if($k == 0)
                               发起人
                           @else
                               接收人
                           @endif
                        </td>
                        <td>部门</td><td>员工</td><td>期望时间</td><td>操作日期</td>
                    </tr>
                    <tr>
                        <td>
                            {{$single['data']['current_department']}} 
                        </td>
                        <td>
                            {{$single['data']['currentone']}}
                        </td>
                        <td>
                            {{date('Y-m-d',$single['data']['expire_time'])}}
                        </td>
                        <td>
                            {{date('Y-m-d',$single['data']['op_time'])}}
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table class='table'>
                    <tr>
                        <td>描述</td>
                        <td>{{$single['data']['remark']}}</td>
                    </tr>
                    <tr>
                        <td>附件</td>
                        <td>
                            <table>
                                @foreach($single['data']['addons'] as $v)
                                <tr>
                                    <td>{{$v}}<a href='downlist?name={{$v}}'>下载</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                     @if($k != 0)
                    <tr>
                        <td>附件</td>
                        <td>
                            <table>
                                
                                <tr>
                                    <td>{{$single['data']['rank']}}</td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
            @endforeach
            @endif
            <!-- 第一个级别结束 -->
            
            <!-- 当前级处理  -->
            @if($current)
            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="2">当前级</td>
                        <td>部门</td>
                        <td>员工</td>
                        <td>预计完成时间</td>
                        <td>操作时间</td>
                    </tr>
                    <tr>
                        <td>{{$current['data']['current_department']}}</td>
                        <td>{{$current['data']['currentone']}}</td>
                        <td>
                            @if($current['write'])
                             @if($current['data']['expire_time'])
                             {!! Form::text('current[expire_time]', date('Y-m-d',$current['data']['expire_time']), ['class' => 'form-control datepicker']) !!}
                             @else
                             {!! Form::text('current[expire_time]', date('Y-m-d',time()), ['class' => 'form-control datepicker']) !!}
                             @endif
                            @else
                             {{date('Y-m-d',$current['data']['expire_time'])}}
                            @endif
                        </td>
                        <td>
                            @if($current['write'])
                              @if($current['data']['op_time'])
                               {!! Form::text('current[op_time]', date('Y-m-d',$current['data']['op_time']), ['class' => 'form-control datepicker']) !!}
                              @else
                               {!! Form::text('current[op_time]', date('Y-m-d',time()), ['class' => 'form-control datepicker']) !!}
                              @endif
                            @else
                            {{date('Y-m-d',$current['data']['op_time'])}}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="3">详情</td>
                        <td>备注</td>
                        <td>
                            @if($current['write'])
                            {!! Form::textarea('current[remark]', $current['data']['remark'], ['class' => 'form-control']) !!}
                            @else
                            {{$current['data']['remark']}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>附件</td>
                        <td>
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
                        </td>
                    </tr>
                    <tr>
                        <td>优先级</td>
                        <td>
                            @if($current['write'])
                            {!! Form::text('current[rank]', $current['data']['rank'], ['class' => 'form-control']) !!}
                            @else
                            {{$current['data']['rank']}}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <!-- 当前级处理结束  -->
            @endif

            <!--  下一级的处理:只需要显示，还有一个部分,判断权限  -->
            @if($next)
            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="2">下一级</td>
                        <td>部门</td>
                        <td>员工</td>
                        <td>预计完成时间</td>
                        <td>操作时间</td>
                    </tr>
                    <tr>
                        <td>{{$next['data']['current_department']}}</td>
                        <td>{{$next['data']['currentone']}}</td>
                        <td>{{$next['data']['expire_time']}}</td>
                        <td>{{$next['data']['op_time']}}</td>
                    </tr>
                </table>
            </div>

            <div>
                <table class='table'>
                    <tr>
                        <td rowspan="3">详情</td>
                        <td>描述</td>
                        <td>{{$next['data']['remark']}}</td>
                    </tr>
                    <tr>
                        <td>附件</td>
                        <td>
                            <table>
                                @foreach($next['data']['addons'] as $v)
                                <tr>
                                    <td>{{$v}}<a href='downlist?name={{$v}}'>下载</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>优先级</td>
                        <td>{{$next['data']['rank']}}</td>
                    </tr>
                </table>
            </div>
            <!--  下一级处理结束  --->
            @else
            @if($current['data']['status']== 'on')
            <div>

                <table class='table'>
                    <tr>
                        <td><button type='button' onclick='hide()' id='add_turn'>添加流转</button></td>
                    </tr>
                </table>
            </div>
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
                                <option value='{{$v->Department_Id}}'>{{$v->Name}}</option>
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
            <div id='finishbtn' class="form-group" >
                <div  id='buttonall' style='text-align:center'>
                    {!! Form::submit('保存', ['class' => 'btn btn-default','id'=>'pass','name'=>'save']) !!}
                    {!! Form::submit('完结', ['class' => 'btn btn-default','id'=>'finish','name'=>'finished']) !!}
                </div>
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
                    if (data.result.error) {
                        alert(data.result.msg);
                    } else {
                        $('#addons_list').append("<tr><td><input type='hidden' name='current[addons][]' value='" + data.result.short + "'>" + data.result.short + "</td></tr>");
                    }
                }
            });
            @endif
    });

    //隐藏
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
        $('#turn_next').show();//展示下一个：
        $('#add_turn').hide();//如何删除流转
    }


</script>

