<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>任务编辑</h4>
        </div>
        <div class="modal-body">


            {!! Form::open(array('url'=>'taskmanage/firstedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
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
                        <span  style="line-height: 45px;">{{$current['data']['current_department']}} </span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span  style="line-height: 45px;"> {{$current['data']['currentone']}}</span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        @if($current['write'])
                            @if($current['data']['expire_time'])
                                {!! Form::text('current[expire_time]', date('Y-m-d',$current['data']['expire_time']), ['class' => 'form-control datepicker']) !!}
                            @else
                                {!! Form::text('current[expire_time]', date('Y-m-d',time()), ['class' => 'form-control datepicker']) !!}
                            @endif
                        @else
                            <span  style="line-height: 45px;">{{$next['data']['current_department']}}</span>
                        @endif

                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">

                        @if($current['write'])
                            @if($current['data']['op_time'])
                                {!! Form::text('current[op_time]', date('Y-m-d',$current['data']['op_time']), ['class' => 'form-control datepicker']) !!}
                            @else
                                {!! Form::text('current[op_time]', date('Y-m-d',time()), ['class' => 'form-control datepicker']) !!}
                            @endif
                        @else
                            <span  style="line-height: 45px;">{{$current['data']['op_time']}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group form-width">

                    <label for="title" class="control-label col-md-1 " style="border: 0">标题</label>
                    <div class="col-md-7">
                    @if($current['write'])
                        {!! Form::text('current[title]', $current['data']['title'], ['class' => 'form-control']) !!}
                    @else
                            <span  style="line-height: 45px;">{{$current['data']['title']}}</span>
                    @endif
                    </div>
                </div>
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1">描述</label>
                    <div class="col-md-7">
                        @if($current['write'])
                            {!! Form::textarea('current[remark]', $current['data']['remark'], ['class' => 'form-control']) !!}
                        @else
                            <span  style="line-height: 45px;">{{$current['data']['remark']}}</span>
                        @endif
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2" />
                    <label for="title" class="control-label col-md-1">附件</label>
                    <div class="col-md-7">
                        <!--  有附件直接显示  这部门不需要再次上传附件了  -->
                        @if($current['write'])
                            <span class="btn btn-success fileinput-button" id='fileupload'>
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>上传附件</span>
                                <input type="file" name="files" multiple>
                            </span>
                            <table id='addons_list'>
                            </table>
                        @endif
                            @foreach($current['data']['addons'] as $v)
                                        @if($current['write'])
                                            <input type='hidden' name='current[addons][]' value='{{$v}}'/>
                                        @endif
                                            <span  style="line-height: 45px;">
                                                {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                                             </span>
                            @endforeach

                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
            <!-- 发起人级别结束 -->
            <!--下一级处理-->
            <div class="main" style="overflow:hidden;">
                <div class="form-group">
                    <label for="title" class="control-label col-md-1 col-md-title">接收人</label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>


                <div class="form-group accordion-group">
                    <label for="title" class="control-label col-md-1 manage-arrow-down"></label>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span  style="line-height: 45px;">{{$next['data']['current_department']}} </span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        <span  style="line-height: 45px;">{{$next['data']['currentone']}}</span>
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        @if($next['data']['expire_time'])
                            <span  style="line-height: 45px;"> {{date('Y-m-d',$next['data']['expire_time'])}}</span>
                        @endif
                    </div>
                    <div class="col-md-7" style="width: 20%;text-align: center;">
                        @if($next['data']['op_time'])
                            <span  style="line-height: 45px;"> {{date('Y-m-d',$next['data']['op_time'])}}</span>
                        @endif

                    </div>
                </div>
                <div class="form-group form-width">

                    <label for="title" class="control-label col-md-1 " style="border: 0">备注</label>
                    <div class="col-md-7">
                            <span  style="line-height: 45px;">{{$next['data']['remark']}}</span>
                    </div>
                </div>

                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2" />
                    <label for="title" class="control-label col-md-1">附件</label>
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
                    <label for="title" class="control-label col-md-1">优先级</label>
                    <div class="col-md-7">
                            <span  style="line-height: 45px;">
                                 {{$next['data']['rank']}}
                             </span>
                    </div>
                </div>

            </div>
            <!--下一级处理-->
            <div class="form-group" >
                <div  style='text-align:center'>
                    @if($current['write'])
                        {!! Form::submit('提交', ['class' => 'btn btn-default','id'=>'pass']) !!}
                    @endif
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
   });
   
</script>
