@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit User</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                @if (!Auth::user()->hasRole('superadminstrator'))
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-default">Cancel</a>
                @else
                    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                @endif
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
