
<div class="col-sm-6">
    {!! Form::label('id', 'Name/Code:') !!}
    <p>{{ $role->name }}</p>
</div>

<div class="col-sm-6">
    {!! Form::label('id', 'Display Name:') !!}
    <p>{{ $role->display_name }}</p>
</div>

<div class="col-sm-6">
    {!! Form::label('id', 'Description:') !!}
    <p>{{ $role->description }}</p>
</div>

<div class="col-sm-6">
    {!! Form::label('id', 'Permissions:') !!}
    <p>
        @foreach ($role->permissions as $permission)
            <li class="text-gray-800 list-disc">{{ $permission->display_name ?? $permission->name }}</li>
        @endforeach
    </p>
</div>
