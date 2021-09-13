
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Role</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($model, ['route' => ['roles.update', $model->id], 'method' => 'patch',         'x-data' => 'laratrustForm()']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

<script>
    window.laratrustForm = function() {
        return {
            displayName: '{{ $model->display_name ?? old('display_name') }}',
            name: '{{ $model->name ?? old('name') }}',
            toKebabCase(str) {
                return str &&
                    str
                    .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                    .map(x => x.toLowerCase())
                    .join('-')
                    .trim();
            },
            onChangeDisplayName(value) {
                this.name = this.toKebabCase(value);
            }
        }
    }
</script>
