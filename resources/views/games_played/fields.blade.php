<!-- Operator Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operator_id', 'Operator Id:') !!}
    {!! Form::select('operator_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Scheme Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scheme', 'Scheme:') !!}
    {!! Form::select('scheme', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>
