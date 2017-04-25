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
                <div class="main">
                    <div class="form-group">
                        <label for="title" class=" col-md-1 col-md-title">
                            @if($k == 0)发起人@else接收人@endif
                        </label>
                        <label for="title" class=" col-md-1 col-md-info">部门</label>
                        <label for="title" class=" col-md-1 col-md-info">员工</label>
                        <label for="title" class=" col-md-1 col-md-info">@if($k == 0)期望时间 @else 预计完成时间 @endif</label>
                        <label for="title" class=" col-md-1 col-md-info">操作日期</label>
                    </div>
                    <div class="form-group accordion-group">
                        @if($k == count($chainData)-1 && $single['status']== 'on')
                        <label for="title" class="accordion-heading col-md-1 manage-label-add">
                            <a id="open-info "  class=" manage-arrow-add accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                +
                            </a>
                        </label>
                        @else
                        <label for="title" class=" col-md-1 manage-arrow-down">↓</label>
                        @endif
                        <div class="col-md-7" style="width: 20%;">
                            <select name="current['current_department'][{{$single['detail_id']}}]"  class="form-control giveperson" style="width: 50%;margin: 0 auto;">
                                @foreach($alldepartment as $v)
                                  <option value="{{$v->Department_id}}" @if($single['current_department'] == $v->Department_id ) selected='selected' @endif>{{$v->Name}}</option>
                                @endforeach
                            </select>
                            <span class="error-span"></span>
                        </div>
                        <div class="col-md-7" style="width: 20%;">
                            <select name="current['currentone'][{{$single['detail_id']}}]"  class="form-control toperson" style="width: 50%;margin: 0 auto;">
                                @foreach($chainData[$k]['allperson'] as $vv)
                                  <option value="{{$vv->User_id}}" @if($single['currentone'] == $vv->Code) selected='selected' @endif>{{$vv->Code}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-md-7" style="width: 20%;">
                                <input name="current['expire_time'][{{$single['detail_id']}}]" value="@if($single['expire_time']) {{date('Y-m-d h:i',$single['expire_time'])}} @endif" type="text" class="time-plug form-control  datepicker " />
                            </div>
                            <div class="col-md-7" style="width: 20%;">
                                <input name="current['op_time'][{{$single['detail_id']}}]" value="@if($single['op_time']) {{date('Y-m-d h:i',$single['op_time'])}} @endif" type="text" class="time-end form-control  datepicker " />
                            </div>
                          </div>
                    @if($k == 0)
                            <div class="form-group form-width">
                                <label for="title" class="control-label col-md-1">标题</label>
                                <div class="col-md-7">
                                    <input name="title"  class="form-control" checkform-type='required' type='text' checkform-msg='标题'  value='{{$mainData['title']}}'  />
                                    <span class="error-span"></span>
                                </div>
                            </div>
                    @endif
                    <div class="form-group form-width">
                        <label for="title" class=" col-md-1"  style="text-align: left;"> @if($k != 0) 备注 @else 描述 @endif</label>
                        <div class="col-md-7" style="width:90%">
                            <textarea class="form-control" name="current['remark'][{{$single['detail_id']}}]" value="{{$single['remark']}}" type="text" id="title" /></textarea>
                            <span class="error-span"></span>
                        </div>
                    </div>
                    <div class="form-group form-width">
                        <label for="title" class=" col-md-1" style="text-align: left;">附件</label>
                        <div class="col-md-7">
                            @if($single['addons'])
                                @foreach($single['addons'] as $v)
                                <span  class="hyperlink">
                                    <a href='downlist?name={{$v}}'>{{$v}}</a>
                                </span>
                                <span>
                                   <a href='downlist?name={{$v}}' class="download" ></a>
                                </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if($k != 0)
                    <div class="form-group form-width">

                        <label for="title" class=" col-md-1"  style="text-align: left;">优先级</label>
                        <div class="col-md-7">
                            <input class="form-control" checkform-type='number' checkform-msg='优先级'  name="current['rank'][{{$single['detail_id']}}]" value="{{$single['rank']}}" type="text" id="title" style="width: 20%;"/>
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
                        <label for="title" class=" col-md-1  col-md-title">
                            接收人
                            <span id="close-info" class="manage-arrow-close">×</span></label>
                        <label for="title" class=" col-md-1 col-md-info" >部门*</label>
                        <label for="title" class=" col-md-1 col-md-info" >员工*</label>
                        <label for="title" class=" col-md-1 col-md-info" >期望时间</label>
                        <label for="title" class=" col-md-1 col-md-info" >操作日期</label>
                    </div>
                    <div class="form-group" >
                        <label for="title" class="col-md-1 col-md-title"></label>
                        <div class="col-md-7" style="width: 20%;">
                            <select  name="next[current_department]" class="form-control giveperson" style="width: 50%;margin: 0 auto;"  checkform-type='required' checkform-msg='部门不能为空' checkform-quick='on' >
                                <option value=''>请选择</option>
                                @foreach($alldepartment as $v)
                                <option value='{{$v->Department_id}}'>{{$v->Name}}</option>
                                @endforeach
                            </select>
                            <span class="error-span"></span>
                        </div>
                        <div class="col-md-7" style="width: 20%;">
                                <select name="next[currentone]" class="form-control toperson" style="width: 50%;margin: 0 auto;" checkform-type='required' checkform-msg='人员不能为空' checkform-quick='on'>
                                    <option value="">请选择员工</option>
                                </select>
                        </div>
                        <div class="col-md-7" style="width: 20%;">
                            <input name="next['expire_time']"  type="text"  class="time-plug form-control  datepicker" >
                        </div>
                        <div class="col-md-7" style="width: 20%;">
                            <input name="next['op_time']"  type="text" class="time-end form-control  datepicker">
                        </div>


                    </div>
                    <div class="form-group  form-width">
                        <label for="title" class="col-md-1"  style="text-align: left;">备注</label>
                        <div class="col-md-7" style="width:90%">
                            <textarea class="form-control" name="next[remark]" type="text" ></textarea>
                            <span class="error-span"></span>
                        </div>
                    </div>

                    <div class="form-group  form-width">
                        <label for="title" class="col-md-1"  style="text-align: left;">优先级</label>
                        <div class="col-md-7">
                            <input class="form-control" name="next[rank]" type="text">
                            <span class="error-span"></span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" onclick='tosubmit(1)'  class="btn btn-success btn-save">保存并提交</button>
                @if($chainData[count($chainData)-1]['status'] == 'on')
                    <button type="button" value="finished" onclick='tosubmit(2)' class="btn btn-success btn-save" id="pass" name="finished">完结</button>
                    <button type="button" value="turn" onclick="tosubmit(3)" class="btn btn-success btn-save" id="pass" name="turn">流转</button> 
                @endif
            </div>
            @endif
            {!! Form::close() !!}
    </div>
</div>
<script type='text/javascript' src='{{ asset('assets/js/formvalidate.js')}}'></script>
<script>
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
    $(function (){
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
