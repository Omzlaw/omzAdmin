<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- How It Works Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('how_it_works', 'How It Works:') !!}
    {!! Form::textarea('how_it_works', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operator_scheme_id', 'Scheme:') !!}
    {!! Form::select('operator_scheme_id', modelDropdown($operator_schemes), null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', enum_game_status(), null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Remark Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
</div>