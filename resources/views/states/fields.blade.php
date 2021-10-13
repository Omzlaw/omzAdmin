<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Region Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('region_id', 'Region Id:') !!}
    {!! Form::select('region_id', ['1' => 'Norrth Central', '' => ' North East', '3' => ' North West', '4' => ' South South', '5' => ' South East', '6' => ' South West'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => ' Inactice'], null, ['class' => 'form-control custom-select']) !!}
</div>
