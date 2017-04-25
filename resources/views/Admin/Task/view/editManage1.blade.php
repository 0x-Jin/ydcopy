<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<<<<<<< .working
            <h4 class="modal-title">工作管理&gt;任务管理&gt;接收人修改</h4>
||||||| .old
            <h4 class="modal-title">工作管理&gt;任务管理&gt;管理员修改</h4>
=======
            <h4 class="modal-title">工作管理>任务管理>管理员修改</h4>
>>>>>>> .new
        </div>
        <div class="modal-body" style="overflow: hidden;">
<<<<<<< .working
            {!! Form::open(array('url'=>'taskmanage/doedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
           
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
                            <div class="col-md-7" style="width: 20%;">
                                {{$single['data']['current_department']}}
                            </div>
                            <div class="col-md-7" style="width: 20%;">
                                {{$single['data']['currentone']}}
                            </div>
                            {{date('Y-m-d h-m-s',$single['data']['expire_time'])}}
                            {{date('Y-m-d h-m-s',$single['data']['op_time'])}}
                        </div>
                        <div class="form-group form-width">
                            <input name="id" type="hidden" value="2" />
                            <label for="title" class="control-label col-md-1">描述</label>
                            <div class="col-md-7">
                                <input class="form-control" name="title" type="text" id="title" />
                                <span class="error-span"></span>
                            </div>
                        </div>
                        <div class="form-group form-width">
                            <input name="id" type="hidden" value="2" />
                            <label for="title" class="control-label col-md-1">附件</label>
                            <div class="col-md-7">
                                <input class="form-control" name="title" type="text" id="title" />
                                <span class="error-span"></span>
                            </div>
                        </div>
                    </div>
                 @endforeach
            @endif
            
            @if($current)
||||||| .old
            {!! Form::open(array('url'=&gt;'taskmanage/adminedit','class'=&gt;'form-horizontal','id'=&gt;'interviewForm')) !!}
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
                    <div class="col-md-7" style="width: 20%;">
                        <select name="current['current_department'][13]" class="form-control"> <option value="">技术</option> <option value="">UI设计</option> </select>
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
                        <select name="current['currentone'][13]" class="form-control"> <option value="">test</option> <option value="">Molo</option> </select>
                    </div>
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker " />
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker " />
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2" />
                    <label for="title" class="control-label col-md-1">描述</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title" />
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2" />
                    <label for="title" class="control-label col-md-1">附件</label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title" />
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
=======
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
                   <span class="form-control" style="text-align: center;border: 0px;width: 100%;">
                    {{$v}}<a href='downlist?name={{$v}}'>下载</a>
                   </span>
                    <span class="error-span"></span>
                </div>
            </div>
>>>>>>> .new
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
<<<<<<< .working
                        {{$current['data']['current_department']}}
||||||| .old
                        <select name="" class="form-control"> <option value="">技术</option> <option value="">UI设计</option> </select>
                        <span class="error-span"></span>
=======
                        <select name="" class="form-control" >
                            <option value="">技术</option>
                            <option value="">UI设计</option>

                        </select>
                        <span class="error-span"></span>
>>>>>>> .new
                    </div>
                    <div class="col-md-7" style="width: 20%;">
<<<<<<< .working
                        {{$current['data']['currentone']}}
||||||| .old
                        <select name="" class="form-control"> <option value="">test</option> <option value="">Molo</option> </select>
=======
                        <select name="" class="form-control">
                            <option value="">test</option>
                            <option value="">Molo</option>
                        </select>
>>>>>>> .new
                    </div>
<<<<<<< .working
                     @if($current['write'])
                        @if($current['data']['expire_time'])
                           <input name="current[expire_time]" value="{{date('Y-m-d',$current['data']['expire_time'])}}" type="text" class="time-plug form-control  datepicker" />
                        @else
                            <input name="current[expire_time]" value="{{date('Y-m-d',time())}}" type="text" class="time-plug form-control  datepicker" />
                        @endif
                     @else
                        {{date('Y-m-d',$current['data']['expire_time'])}}
                     @endif
                     
                     @if($current['write'])
                        @if($current['data']['op_time'])
                            {!! Form::text('current[op_time]', date('Y-m-d',$current['data']['op_time']), ['class' => 'time-plug form-control datepicker']) !!}
                        @else

                           {!! Form::text('current[op_time]', date('Y-m-d',time()), ['class' => 'time-plug form-control datepicker']) !!}

                        @endif
                     @else
                        {{date('Y-m-d',$current['data']['op_time'])}}
                     @endif
||||||| .old
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" />
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker" />
=======
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" >
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker" >
>>>>>>> .new
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">备注</label>
<<<<<<< .working
                        <div class="col-md-7">
                             @if($current['write'])
                                {!! Form::textarea('current[remark]', $current['data']['remark'], ['class' => 'form-control']) !!}
                                <span class="error-span"></span>
                            @else
                               {{$current['data']['remark']}}
                            @endif
                        </div>
||||||| .old
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title" />
                        <span class="error-span"></span>
                    </div>
=======
                    <div class="col-md-7">
                        <input class="form-control" name="title" type="text" id="title">
                        <span class="error-span"></span>
                    </div>
>>>>>>> .new
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
<<<<<<< .working
            @endif
            
             @if($next)
            <div class="accordion-body collapse main mian-info" id="collapseTwo">
||||||| .old
            <div class="accordion-body collapse main mian-info" id="collapseTwo">
=======

            <div class="accordion-body collapse main mian-info" id="collapseTwo" >
>>>>>>> .new
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
<<<<<<< .working
                        {{$next['data']['current_department']}}
||||||| .old
                        <select name="" class="form-control"> <option value="">技术</option> <option value="">UI设计</option> </select>
=======
                        <select name="" class="form-control" >
                            <option value="">技术</option>
                            <option value="">UI设计</option>
                        </select>
>>>>>>> .new
                        <span class="error-span"></span>
                    </div>
                    <div class="col-md-7" style="width: 20%;">
<<<<<<< .working
                        {{$next['data']['currentone']}}
||||||| .old
                        <select name="" class="form-control"> <option value="">test</option> <option value="">Molo</option> </select>
=======
                        <select name="" class="form-control">
                            <option value="">test</option>
                            <option value="">Molo</option>
                        </select>
>>>>>>> .new
                    </div>
<<<<<<< .working
                     {{$next['data']['expire_time']}}
                     {{$next['data']['op_time']}}
||||||| .old
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" />
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker" />
=======
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-plug form-control  datepicker" >
                    <input name="current['expire_time'][13]" value=" 2016-04-27 " type="text" class="time-end form-control  datepicker">

>>>>>>> .new
                </div>
                <div class="form-group form-width">
                    <input name="id" type="hidden" value="2">
                    <label for="title" class="control-label col-md-1">备注</label>
                    <div class="col-md-7">
<<<<<<< .working
                        {{$next['data']['remark']}}
||||||| .old
                        <input class="form-control" name="title" type="text" id="title" />
=======
                        <input class="form-control" name="title" type="text" id="title">
>>>>>>> .new
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
<<<<<<< .working
                        {{$next['data']['rank']}}
||||||| .old
                        <input class="form-control" name="title" type="text" id="title" />
=======
                        <input class="form-control" name="title" type="text" id="title">
>>>>>>> .new
                        <span class="error-span"></span>
                    </div>
                </div>
            </div>
<<<<<<< .working
             @endif
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-save">保存并提交</button>
            </div> {!! Form::close() !!}
||||||| .old
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-save">保存并提交</button>
            </div> {!! Form::close() !!}
=======
>>>>>>> .new
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

