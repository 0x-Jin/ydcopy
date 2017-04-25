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
                        @if($k == 0)发起人@else接收人@endif
                    </label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">@if($k == 0)期望时间 @else 预计完成时间 @endif</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>
                <div class="form-group accordion-group">
                    @if($k == count($chainData)-1 && $single['status']== 'on')
                    <label for="title" class="accordion-heading control-label col-md-1 manage-label-add">
                        <button id="open-info " onclick="add_node();"  class=" manage-arrow-add accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            +
                        </button>
                    </label>
                    @elseif($k != count($chainData)-1 && $single['status']== 'finished')
                    <label for="title" class="control-label col-md-1 manage-arrow-down">↓</label>
                    @else
                    <label for="title" class="control-label col-md-1 manage-arrow-down"></label>
                    @endif
                    <div class="col-md-7" style="width: 20%;">
                        <select checkform-type='required' checkform-msg='部门不能为空' name="current['current_department'][{{$single['detail_id']}}]" class="form-control giveperson"> 
                            @foreach($alldepartment as $v)
                            <option value="{{$v->Department_id}}" @if($single['current_department'] == $v->Department_id ) selected='selected' @endif>{{$v->Name}}</option>
                            @endforeach
                        </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select checkform-type='required' checkform-msg='员工不能为空' name="current['currentone'][{{$single['detail_id']}}]" class="form-control toperson">
                            @foreach($chainData[$k]['allperson'] as $vv)
                            <option value="{{$vv->User_id}}" @if($single['currentone'] == $vv->Code) selected='selected' @endif>{{$vv->Code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input name="current['expire_time'][{{$single['detail_id']}}]" value="@if($single['expire_time']) {{date('Y-m-d h:m',$single['expire_time'])}} @endif" type="text" class="time-plug form-control  datetimepicker " />
                    <input name="current['op_time'][{{$single['detail_id']}}]"     value="@if($single['op_time']) {{date('Y-m-d h:m',$single['op_time'])}} @endif" type="text" class="time-end form-control  datetimepicker " />
                </div>
                @if($k == 0)
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1">标题</label>
                    <div class="col-md-7">
                        <input name="title"  class="form-control" checkform-type='required' type='text' checkform-msg='标题不能为空'  value='{{$mainData['title']}}'  />
                        <span class="error-span"></span>
                    </div>
                </div>
                @endif
                <div class="form-group form-width">
                    <label for="title" class="control-label col-md-1"> @if($k != 0) 备注 @else 描述 @endif</label>
                    <div class="col-md-7">
                        <input class="form-control" name="current['remark'][{{$single['detail_id']}}]" value="{{$single['remark']}}" type="text" />
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
                        <input class="form-control" checkform-type='number' checkform-msg='优先级必须为数字' name="current['rank'][{{$single['detail_id']}}]" value="{{$single['rank']}}" type="text" />
                        <span class="error-span"></span>
                    </div>
                </div>
                @endif
            </div>
            @endforeach

            @if($chainData[count($chainData)-1]['status'] == 'on')
            <!--最后一级没有结束，并且添加 -->
            <div class="accordion-body collapse main mian-info" id="collapseTwo" >
                <div class="form-group">
                    <label for="title" class="control-label col-md-1  col-md-title">
                        接收人
                        <span id="close-info" class="manage-arrow-close" onclick="addnode()">×</span></label>
                    <label for="title" class="control-label col-md-1 col-md-info" >部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >期望时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >操作日期</label>
                </div>
                <div class="form-group" >
                    <label for="title" class="control-label col-md-1 col-md-title"></label>
                    <div class="col-md-7" style="width: 20%;">
                        <select  name="next[current_department]" class="form-control giveperson" checkform-type='required' checkform-msg='部门不能为空' checkform-quick='on' >
                            <option value=''>请选择</option>
                            @foreach($alldepartment as $v)
                            <option value='{{$v->Department_id}}'>{{$v->Name}}</option>
                            @endforeach
                        </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="next[currentone]" class="form-control toperson" checkform-type='required' checkform-msg='人员不能为空' checkform-quick='on'>
                            <option value="">请选择员工</option>
                        </select>
                        <span class="error-span"></span>
                    </div>
                    <input name="next['expire_time']"  type="text" class="time-plug form-control  datetimepicker" >
                    <input name="next['op_time']"  type="text" class="time-end form-control  datetimepicker">
                </div>
                <div class="form-group  form-width" >
                    <label for="title" class="control-label col-md-1">备注</label>
                    <div class="col-md-7">
                        <input class="form-control" name="next[remark]" type="text" >
                        <span class="error-span"></span>
                    </div>
                </div>

                <div class="form-group  form-width">
                    <label for="title" class="control-label col-md-1">优先级</label>
                    <div class="col-md-7">
                        <input class="form-control" name="next[rank]" type="text">
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" onclick='tosubmit(1)'  class="btn btn-success btn-save">保存并提交</button>
            @if($chainData[count($chainData)-1]['status'] == 'on')
            <button type="button" value="finished" onclick='tosubmit(2)' class="btn btn-success btn-save" id="pass" name="finished">完结</button>
            <button type="button" value="turn" style="display: none" onclick="tosubmit(3)" class="btn btn-success btn-save" id="turn_node" name="turn">流转</button> 
            @endif
        </div>
        @endif
        {!! Form::close() !!}
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
    var direction = 1;
    //添加
    function add_node(){
        if(direction == 1){
           $('#turn_node').show();
        }
        else{
            $('#turn_node').hide();
        }
        direction *= -1;  
    }

    //
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
        $("#close-info").click(function () {
            $(".mian-info").removeClass("in");
            $(".mian-info").addClass("collapse");
            if ($(".mian-info .collapse").is(":hidden")) {
                $('.modal-body').find('#open-info').css('color', 'green')
            } else {
                $('.modal-body').find('#open-info').css('color', 'red')
            }
        })
    });
    //
//    function giveperson() {
//        var val = $("#getone").find("option:selected").val();
//        if (val == '') {
//            $('#worker').html('');
//            $('#worker').append("<option value=''>请选择部门</option>");
//        }
//        //请求部分
//        $.ajax({
//            type: "GET",
//            url: "getperson",
//            data: {did: val},
//            dataType: "html",
//            success: function (data) {
//                $('#worker').html('');
//                $('#worker').append(data);
//            }
//        });
//    }

    $(function () {
        $(".datetimepicker").datetimepicker({
            format: "yyyy-mm-dd hh:ii"
        });
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
