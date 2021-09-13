<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name/Code:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'this-will-be-the-code-name', ':value' => 'name', 'readonly' => true]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Edit user profile', 'x-model' => 'displayName']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textArea('description', $model->description ?? old('description'), ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('permissions[]', 'Permissions:') !!}
    <div class="flex flex-wrap justify-start mb-4">
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-6 mb-3">
                    {!! Form::checkbox('permissions[]', $permission->id, ['class' => 'form-control form-checkbox h-4 w-4', 'checked' => $permission->assigned]) !!}
                    <span class="">{{ $permission->display_name ?? $permission->name }}</span>
                </div>
            @endforeach
        </div>
    </div>

</div>
