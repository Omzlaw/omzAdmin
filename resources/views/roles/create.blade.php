@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Role</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'roles.store', 'x-data' => 'laratrustForm()']) !!}

            <div class="card-body">

                <div class="row">
                    {{-- @include('roles.fields') --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('name', 'Name/Code:') !!}
                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'this-will-be-the-code-name', 'readonly' => true]) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('display_name', 'Display Name:') !!}
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Edit user profile', 'onkeyup' => 'setName(this.value)']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textArea('description', $model->description ?? old('description'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('permissions[]', 'Permissions:') !!}
                        @foreach ($permissions as $permission)
                            {{-- <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="{{ $permission->id }}"
                                    {!! $permission->assigned ? 'checked' : '' !!}> --}}
                            {!! Form::checkbox('permissions[]', $permission->id, ['class' => 'form-control', 'checked' => $permission->assigned]) !!}
                            <span class="ml-2">{{ $permission->display_name ?? $permission->name }}</span>
                        @endforeach

                    </div>

                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}


        </div>
    </div>

    <script>
        function setName(value) {
            document.getElementById('name').value = toKebabCase(value);
        }

        function toKebabCase(str) {
            return str &&
                str
                .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                .map(x => x.toLowerCase())
                .join('-')
                .trim();
        }
    </script>
@endsection
