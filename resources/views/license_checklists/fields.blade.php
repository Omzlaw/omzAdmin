<!-- Requirement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('requirement', 'Requirement:') !!}
    {!! Form::text('requirement', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Lottery Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_lottery', 'Is Lottery:') !!}
    {!! Form::select('is_lottery', ['-1' => 'Select', '1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Is Sportbet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_sportbet', 'Is Sportbet:') !!}
    {!! Form::select('is_sportbet', ['-1' => 'Select', '1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Is Mobile Gaming Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_mobile_gaming', 'Is Mobile Gaming:') !!}
    {!! Form::select('is_mobile_gaming', ['-1' => 'Select', '1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Is Promo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_promo', 'Is Promo:') !!}
    {!! Form::select('is_promo', ['-1' => 'Select', '1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['-1' => 'Select', '1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control custom-select']) !!}
</div>
