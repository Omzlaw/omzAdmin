<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
      {!! Form::label('password', 'Password Confirmation') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('profile_picture', 'Profile Picture:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('profile_picture', ['class' => 'custom-file-input']) !!}
            {!! Form::label('profile_picture', 'Upload File', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>

