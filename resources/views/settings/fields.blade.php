<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', 'Key:') !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
</div>

<!-- Values Field -->
<div class="form-group col-sm-6">
    {!! Form::label('values', 'Values:') !!}
    {!! Form::text('values', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Editable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_editable', 'Is Editable:') !!}
    {!! Form::select('is_editable', ['1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control custom-select']) !!}
</div>
