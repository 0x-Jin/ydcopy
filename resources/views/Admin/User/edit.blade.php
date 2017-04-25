<div class="modal-dialog" style="width: 1080px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">*>*>*</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url'=>'userdoedit','class'=>'form-horizontal','id'=>'interviewForm')) !!}
                 {!! Form::hidden('id', $data->id) !!}
                 
                 {!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
                 
                 {!! Form::text('age', $data->age, ['class' => 'form-control']) !!}
                 
                 {!! Form::text('height', $data->height, ['class' => 'form-control']) !!}
                 
                 {!! Form::submit('提交', ['class' => 'btn btn-default','id'=>'pass']) !!}
                 
            {!! Form::close() !!}
    </div>
</div>
<script src="{{ asset('assets/js/jquery-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/js/jquery-upload/js/jquery.fileupload.min.js') }}"></script>
<script type='text/javascript' src='{{ asset('assets/js/formvalidate.js')}}'></script>
<script>
    $(function () {
        $('#pass').on('click',function(event){
            event.preventDefault();
            $.ajax({
              url: '/ydcopy/userdoedit',
              type: 'POST',
              data: $('#interviewForm').serialize(),
              dataType: "json",
              success: function(data){
                 console.log(data);
              }
            });
        });
    });
</script>

