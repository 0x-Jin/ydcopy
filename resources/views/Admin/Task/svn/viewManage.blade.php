<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">工作管理>任务管理>任务查看</h4>
        </div>
        <div class="modal-body">
            @if($newData)
            @foreach($newData as $k=>$single)
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
                            {{$single['current_department']}} 
                        </td>
                        <td>
                            {{$single['currentone']}}
                        </td>
                        <td>
                            @if($single['expire_time'])
                            {{date('Y-m-d',$single['expire_time'])}}
                            @endif
                        </td>
                        <td>
                             @if($single['op_time'])
                            {{date('Y-m-d',$single['op_time'])}}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <table class='table'>
                    
                    <tr>
                        <td>
                            @if($k != 0) 备注 @else 描述 @endif</td>
                        <td>{{$single['remark']}}</td>
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
                                    <td>{{$single['rank']}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>


