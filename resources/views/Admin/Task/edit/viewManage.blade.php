<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>任务查看</h4>
        </div>
        <div class="modal-body">
             @if($newData)
             @foreach($newData as $k=>$single)
            <div class="main" style="overflow:hidden;">
                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 col-md-title">
                            @if($k==1)发起人
                            @else 接收人
                            @endif
                        </label>
                        <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                        <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                        <label for="title" class="control-label col-md-1 col-md-info">
                            @if($k==1)期望时间
                            @else 预计时间
                            @endif
                        </label>
                        <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                    </div>
                    <div class="form-group accordion-group">
                        <label for="title" class="control-label col-md-1 manage-arrow-down">↓</label>
                        <div class="col-md-7" style="width: 20%;text-align: center;">
                            <span style="text-align: center;">
                                {{$single['current_department']}}
                            </span>
                            <span class="error-span"></span>
                        </div>
                        <div class="col-md-7" style="width: 20%;text-align: center;">
                            <span style="text-align: center;">  {{$single['currentone']}} </span>
                        </div>
                        <span class="time-plug " style="text-align: center;">
                            @if($single['expire_time'])
                                {{date('Y-m-d h-m-s',$single['expire_time'])}}
                            @endif
                        </span>
                        <span class="time-end " style="text-align: center;">
                             @if($single['op_time'])
                                {{date('Y-m-d h-m-s',$single['op_time'])}}
                            @endif
                        </span>
                    </div>
                    <div class="form-group form-width">
                        <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">描述</label>
                        <div class="col-md-7">
                            <span style="text-align: center;"id="title" >{{$single['remark']}}</span>
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group form-width">

                        <label for="title" class="control-label col-md-1 col-md-info" style="border: 0px">附件</label>
                        <div class="col-md-7">
                            @if($single['addons'])
                            @foreach($single['addons'] as $v)
                            <span style="line-height: 45px;">
                                {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                            </span>
                            @endforeach
                            @endif
                            <span class="error-span"></span>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
</div>


