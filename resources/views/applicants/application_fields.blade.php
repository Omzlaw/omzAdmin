<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- Rc Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('RC_number', 'RC Number:') !!}
    {!! Form::text('RC_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logo', 'Logo:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('logo', ['class' => 'custom-file-input']) !!}
            {!! Form::label('logo', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>



<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control' , 'disabled']) !!}
</div>

<!-- No Of Shareholders Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_shareholders', 'No Of Shareholders:') !!}
    {!! Form::number('no_of_shareholders', null, ['class' => 'form-control']) !!}
</div>


<!-- No Of Directors Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_directors', 'No Of Directors:') !!}
    {!! Form::number('no_of_directors', null, ['class' => 'form-control']) !!}
</div>




<!-- Documents Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documents', 'Documents:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('documents', ['class' => 'custom-file-input', 'multiple' => true]) !!}
            {!! Form::label('documents', 'Choose files', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

