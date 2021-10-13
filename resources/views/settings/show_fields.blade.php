<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $setting->id }}</p>
</div>

<!-- Key Field -->
<div class="col-sm-12">
    {!! Form::label('key', 'Key:') !!}
    <p>{{ $setting->key }}</p>
</div>

<!-- Values Field -->
<div class="col-sm-12">
    {!! Form::label('values', 'Values:') !!}
    <p>{{ $setting->values }}</p>
</div>

<!-- Is Editable Field -->
<div class="col-sm-12">
    {!! Form::label('is_editable', 'Is Editable:') !!}
    <p>{{ $setting->is_editable }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $setting->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $setting->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $setting->updated_at }}</p>
</div>

