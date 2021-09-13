@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit {{ $user->name }} roles and permissions</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::model($modelKey, ['route' => ['roles-assignment.update', $user->id], 'method' => 'patch']) !!}
            <input type="hidden" name="model" value="{{ $modelKey }}">

            <div class="card-body">
                <div class="row">
                    @include('roles-assignment.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles-assignment.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
