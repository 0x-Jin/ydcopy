<div class="form-group">
    <label class="control-label">记录时间：</label>
    {{ Form::input('text', 'recordStart', old('recordStart'), ['class'=>'form-control datepicker']) }}
    <span class="add-on control-label">至</span>
    {{ Form::input('text', 'recordEnd', old('recordEnd'), ['class'=>'form-control datepicker']) }}
</div>
<div class="form-group">
    <label class="control-label">制单时间：</label>
    {{ Form::input('text', 'createStart', old('createStart'), ['class'=>'form-control datepicker']) }}
    <span class="add-on control-label">至</span>
    {{ Form::input('text', 'createEnd', old('createEnd'), ['class'=>'form-control datepicker']) }}
</div>
<div class="form-group">
    <label class="control-label">支付时间：</label>
    {{ Form::input('text', 'payStart', old('payStart'), ['class'=>'form-control datepicker']) }}
    <span class="add-on control-label">至</span>
    {{ Form::input('text', 'payEnd', old('payEnd'), ['class'=>'form-control datepicker']) }}
</div>
<div class="form-group">
    <label class="control-label">平台发货时间：</label>
    {{ Form::input('text', 'platStart', old('platStart'), ['class'=>'form-control datepicker']) }}
    <span class="add-on control-label">至</span>
    {{ Form::input('text', 'platEnd', old('platEnd'), ['class'=>'form-control datepicker']) }}
</div>
<div class="form-group">
    <label class="control-label">仓库发货时间：</label>
    {{ Form::input('text', 'deliveryStart', old('deliveryStart'), ['class'=>'form-control datepicker']) }}
    <span class="add-on control-label">至</span>
    {{ Form::input('text', 'deliveryEnd', old('deliveryEnd'), ['class'=>'form-control datepicker']) }}
</div>