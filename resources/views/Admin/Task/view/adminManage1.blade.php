<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>管理员修改</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'taskmanage/adminedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
                @if($chainData)
                @foreach($chainData as $k=>$single)
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
                            <td>部门</td>
                            <td>员工</td>
                            <td>@if($k == 0)期望时间 @else 预计完成时间 @endif</td>
                            <td>操作日期</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="current['current_department'][{{$single['detail_id']}}]" class="form-control">
                                    @foreach($alldepartment as $v)
                                        <option value="{{$v->Department_id}}" @if($single['current_department'] == $v->Department_id ) selected='selected' @endif>{{$v->Name}}</option>
                                    @endforeach
                                </select>                                
                            </td>
                            <td>
                                <select name="current['currentone'][{{$single['detail_id']}}]" class="form-control">
                                   @foreach($single['allperson'] as $vv)
                                       <option value="{{$vv->User_Id}}" @if($single['currentone'] == $vv->User_Id ) selected='selected' @endif>{{$vv->Description}}</option>
                                   @endforeach
                                </select>
                            </td>
                            <td>
                                <input name="current['expire_time'][{{$single['detail_id']}}]" value="@if($single['expire_time']) {{date('Y-m-d',$single['expire_time'])}} @endif" type="text"  class="form-control  datepicker"/>
                            </td>
                            <td>
                                <input name="current['op_time'][{{$single['detail_id']}}]" value="@if($single['op_time']) {{date('Y-m-d',$single['op_time'])}} @endif" type="text"  class="form-control  datepicker"/>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class='table'>

                        <tr>
                            <td>
                                @if($k != 0) 备注 @else 描述 @endif</td>
                            <td>
                                <input name="current['remark'][{{$single['detail_id']}}]" value="{{$single['remark']}}" type="text"  class="form-control"/>
                            </td>
                        </tr>

                        <tr>
                            <td>附件</td>
                            <td>
                                <table>
                                    @if($single['addons'])
                                    @foreach($single['addons'] as $v)
                                    <tr>
                                        <td>{{$v}}<a href='downlist?name={{$v}}'>下载</a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </td>
                        </tr>
                         @if($k != 0)
                        <tr>
                            <td>优先级</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <input name="current['rank'][{{$single['detail_id']}}]" value="{{$single['rank']}}" type="text"  class="form-control"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
                @endforeach
                @endif
            <div class="form-group" >
                <div  style='text-align:center'>
                       {!! Form::submit('提交', ['class' => 'btn btn-default','id'=>'pass']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
   $(function(){
         $(".datepicker").datepicker();
         });
</script>
