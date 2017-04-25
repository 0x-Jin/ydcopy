<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">投诉管理>投诉编辑</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'consult/doEdit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
            {!! Form::hidden('id',$data->consult_id) !!}
            <div class="form-group">
                {!! Form::label('realname', '投诉人姓名:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('realname',  $data->realname, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('name','投诉平台:',['class'=>'col-sm-3 control-label'])  !!}
                <div class="col-sm-9">
                    {!! Form::text('platform', $data->platform, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title','投诉主题:',['class'=>'col-sm-3 control-label'])  !!}
                <div class="col-sm-9">
                    {!! Form::text('title', $data->title, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('body', '投诉内容:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('body', $data->body, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '相关附件:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    @foreach($images as $v)
                    <image width='100' height='100' src='{{$v}}' onclick='Scale_On()' />
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '联系手机:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('tellphone', $data->tellphone, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', 'E-mail:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('email',  $data->email, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '联系地址:',['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('address', $data->address, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '备注:',['class'=>'col-sm-3 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('comment', $data->remark, ['class' => 'form-control','readonly']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '处理备注:',['class'=>'col-sm-3 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('check', $data->check_remark, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('append', '状态:',['class'=>'col-sm-3 control-label']) !!}
                <div class='col-sm-9'>
                    <select name='status' class="form-control">
                        <option value='review' @if($data->status == 'review' ) selected='selected'  @endif>审核中</option>
                        <option value='pass' @if($data->status == 'pass' ) selected='selected'  @endif>通过</option>
                        <option value='end' @if($data->status == 'end' ) selected='selected'  @endif>完结</option>
                    </select>
                </div>
            </div>
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
    //请求数据，提交输出数据，
    
    //bootstrap.validation 
    $(document).ready(function () {
        $('#interviewForm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            //要验证的字段：：
            fields: {
                'title': {
                    validators: {
                        notEmpty:{
                            message: '标题不能为空'
                        },
                        stringLength: {
                        min: 4,
                        max: 16,
                        message: '标题长度只能在 %s - %s 之间'
                        },
                    }
                },
                'realname': {
                    validators: {
                        notEmpty:{
                            message: '姓名不能为空'
                        },
                        stringLength: {
                        min: 2,
                        max: 4,
                        message: '姓名长度只能在 %s - %s 之间'
                        },
                    }
                },
//                'body': {
//                    validators: {
//                        notEmpty:{
//                            message: '内容不能为空'
//                        },
//                       stringLength: {
//                        min: 6,
//                        max: 30,
//                        message: '填写长度请保持在%s - %s 之间'
//                       },
//                    }
//                },
//                'tellphone':{
//                    validators:{
//                        notEmpty:{
//                            message: '电话号码不能为空'
//                        },
//                       regexp: {
//                        regexp: /^1[0-9]{10}$/,
//                        message: '电话号码错误'
//                       },
//                    }
//                },
//                'email':{
//                    validators: {
//                    notEmpty: {
//                        message: 'email不能为空'
//                    },
//                    emailAddress: {
//                        message: 'email地址不正确'
//                    }
//                   }
//                },
//                'address':{
//                    validators: {
//                    notEmpty: {
//                        message: '地址不能为空'
//                    }
//                   }
//                },
//                'comment':{
//                    validators: {
//                    notEmpty: {
//                        message: '备注处理不能为空'
//                    }
//                   }
//                },
//                'check':{
//                    validators: {
//                    notEmpty: {
//                        message: '备注处理不能为空'
//                    }
//                   }
//                },
            }
        });
    });
    //放大效果

</script>



