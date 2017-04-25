<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>管理员修改</h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
            {!! Form::open(array('url'=>'taskmanage/adminedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            <div class="main" style="overflow:hidden;">
            <div class="form-group">

                <label for="title" class="control-label col-md-1 col-md-title">发起人</label>
                <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                <label for="title" class="control-label col-md-1 col-md-info" >员工</label>
                <label for="title" class="control-label col-md-1 col-md-info" >期望时间</label>
                <label for="title" class="control-label col-md-1 col-md-info" >操作日期</label>

            </div>
            <div class="form-group accordion-group">

                <label for="title" class="control-label col-md-1 manage-arrow-down" >↓</label>

                <div class="col-md-7" style="width: 20%;">
                    <select name="current['current_department'][13]" class="form-control" >
                        <option value="">技术</option>
                        <option value="">UI设计</option>

                    </select>
                    <span class="error-span"></span>
                </div>
                <div class="col-md-7" style="width: 20%;">
                <select name="current['currentone'][13]" class="form-control">
                    <option value="">test</option>
                    <option value="">Molo</option>
                </select>
                </div>
                <input  name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker ">
                <input  name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker ">

            </div>
            <div class="form-group form-width" >
                <input name="id" type="hidden" value="2">
                <label for="title" class="control-label col-md-1">描述</label>
                <div class="col-md-7">
                    <input class="form-control" name="title" type="text" id="title">
                    <span class="error-span"></span>
                </div>
            </div>
            <div class="form-group form-width">
                <input name="id" type="hidden" value="2">
                <label for="title" class="control-label col-md-1">附件</label>
                <div class="col-md-7">
                   <span  style="line-height: 45px;">
                    附件地址<a href="#">下载</a>
                   </span>
                    <span class="error-span"></span>
                </div>
            </div>
                </div>
            <div class="main" style="overflow: hidden;">
                <div class="form-group">
                    <label for="title" class="control-label col-md-1 col-md-title">接收人</label>
                    <label for="title" class="control-label col-md-1 col-md-info">部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info">员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info">期望时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info">操作日期</label>
                </div>
                <div class="form-group">
                   <label for="title" class="accordion-heading control-label col-md-1 manage-label-add">
                       <a id="open-info "  class=" manage-arrow-add accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                           +
                       </a>
                    </label>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="" class="form-control" >
                            <option value="">技术</option>
                            <option value="">UI设计</option>

                        </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="" class="form-control">
                            <option value="">test</option>
                            <option value="">Molo</option>
                        </select>
                    </div>
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" >
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker" >
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">备注</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">附件</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">优先级</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>

            <div class="accordion-body collapse main mian-info" id="collapseTwo" >
                <div class="form-group">
                    <label for="title" class="control-label col-md-1  col-md-title">
                        最后接收人
                        <span id="close-info" class="manage-arrow-close">×</span></label>
                    <label for="title" class="control-label col-md-1 col-md-info" >部门</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >员工</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >期望时间</label>
                    <label for="title" class="control-label col-md-1 col-md-info" >操作日期</label>

                </div>
                <div class="form-group" >

                    <label for="title" class="control-label col-md-1 col-md-title"></label>

                    <div class="col-md-7" style="width: 20%;">
                        <select name="" class="form-control" >
                            <option value="">技术</option>
                            <option value="">UI设计</option>
                        </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="" class="form-control">
                            <option value="">test</option>
                            <option value="">Molo</option>
                        </select>
                    </div>
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" >
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker">

                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">备注</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">附件</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">优先级</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-save">保存并提交</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    $(function () {
        $("#close-info").click(function () {
            $(".mian-info").removeClass("in");
             $(".mian-info").addClass("collapse");
            if ($(".mian-info .collapse").is(":hidden")) {
                $('.modal-body').find('#open-info').css('color','green')
            }else{
                $('.modal-body').find('#open-info').css('color','red')
            }


        })
    });
    $(function(){

        $(".datepicker").datepicker();
    });
</script>

