<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'this-will-be-the-code-name', 'readonly' => true, 'autocomplete' => true]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('roles[]', 'Roles:') !!}
    <div class="">
        <div class=" row">
        @foreach ($roles as $role)
            <div class="col-4">
                <label class=" inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                    <input type="checkbox" @if ($role->assigned && !$role->isRemovable)
                    class="form-checkbox focus:shadow-none focus:border-transparent text-gray-500 h-4 w-4"
                @else
                    class="form-checkbox h-4 w-4"
        @endif
        name="roles[]"
        value="{{ $role->id }}"
        {!! $role->assigned ? 'checked' : '' !!}
        {!! $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' !!}
        >
        <span class="ml-2 {!! $role->assigned && !$role->isRemovable ? 'text-gray-600' : '' !!}">
            {{ $role->display_name ?? $role->name }}
        </span>
        </label>
    </div>
    @endforeach
</div>
</div>
</div>

<div class="form-group col-sm-6">
    @if ($permissions)
        {!! Form::label('permissions[]', 'Permissions:') !!}
        <div class="flex flex-wrap justify-start mb-4">
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-4 mb-3">
                        {!! Form::checkbox('permissions[]', $permission->id, ['class' => 'form-control form-checkbox h-4 w-4', 'checked' => $permission->assigned]) !!}
                        <span class="">{{ $permission->display_name ?? $permission->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
