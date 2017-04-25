<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理&gt;任务管理&gt;管理员修改</h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
            {!! Form::open(array('url'=>'taskmanage/adminedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            @if($chainData)
                @foreach($chainData as $k=>$single)
                <div class="main" style="overflow:hidden;">
                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 col-md-title">
                            @if($k == 0)
                            发起人
                            @else
                            接收人
                            @endif
                        </label>
                        <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                        <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                        <label for="title" class="control-label col-md-1 col-md-info">@if($k == 0)期望时间 @else 预计完成时间 @endif</label>
                        <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                    </div>
                    <div class="form-group accordion-group">
                        <label for="title" class="control-label col-md-1 manage-arrow-down">↓</label>
                        <div class="col-md-7" style="width: 20%;">
                            <select name="current['current_department'][{{$single['detail_id']}}]" class="form-control giveperson"> 
                                @foreach($alldepartment as $v)
                                <option value="{{$v->Department_Id}}" @if($single['current_department'] == $v->Department_Id ) selected='selected' @endif>{{$v->Name}}</option>
                                @endforeach
                            </select>
                            <span class="error-span"></span>
                        </div>
                        <div class="col-md-7" style="width: 20%;">
                            <select name="current['currentone'][{{$single['detail_id']}}]" class="form-control toperson">
                                @foreach($single['allperson'] as $vv)
                                <option value="{{$vv->User_Id}}" @if($single['currentone'] == $vv->User_Id ) selected='selected' @endif>{{$vv->Description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="current['expire_time'][{{$single['detail_id']}}]" value="@if($single['expire_time']) {{date('Y-m-d',$single['expire_time'])}} @endif" type="text" class="time-plug form-control  datepicker " />
                        <input name="current['op_time'][{{$single['detail_id']}}]" value="@if($single['op_time']) {{date('Y-m-d',$single['op_time'])}} @endif" type="text" class="time-end form-control  datepicker " />
                    </div>
                    <div class="form-group form-width">
                       
                        <label for="title" class="control-label col-md-1"> @if($k != 0) 备注 @else 描述 @endif</label>
                        <div class="col-md-7">
                            <input class="form-control" name="current['remark'][{{$single['detail_id']}}]" value="{{$single['remark']}}" type="text" id="title" />
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group form-width">
                       
                        <label for="title" class="control-label col-md-1">附件</label>
                        <div class="col-md-7">
                            @if($single['addons'])
                                @foreach($single['addons'] as $v)
                                    <span style="line-height: 45px;">
                                        {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if($k != 0)
                    <div class="form-group form-width">
                       
                        <label for="title" class="control-label col-md-1">优先级</label>
                        <div class="col-md-7">
                            <input class="form-control" name="current['rank'][{{$single['detail_id']}}]" value="{{$single['rank']}}" type="text" id="title" />
                            <span class="error-span"></span>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-save">保存并提交</button>
            </div>
            @endif
            {!! Form::close() !!}
        </div>

    </div>
</div>

<script>
//    $(function () {
//        $("#close-info").click(function () {
//            $(".mian-info").removeClass("in");
//            $(".mian-info").addClass("collapse");
//            if ($(".mian-info .collapse").is(":hidden")) {
//                $('.modal-body').find('#open-info').css('color','green')
//            }else{
//                $('.modal-body').find('#open-info').css('color','red')
//            }
//        })
//    });

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




    $(function () {
        $(".datepicker").datepicker();

        $('.giveperson').each(function () {
            var ind = $('.giveperson').index(this);
            $(this).change(function () {
                var val = $(this).find("option:selected").val();
                $.ajax({
                    type: "GET",
                    url: "getperson",
                    data: {did: val},
                    dataType: "html",
                    success: function (data) {
                        $('.toperson').eq(ind).html('');
                        $('.toperson').eq(ind).append(data);
                    }
                });
            });
        });
    });
</script>
