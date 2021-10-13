@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Operator Directors</h1>
                </div>
                <div class="col-sm-6">
                    {{-- @role('operator')
                        <a class="btn btn-primary float-right" href="{{ route('operatorDirectors.create') }}">
                            Add New
                        </a>
                    @endrole --}}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3">
                @include('operator_directors.table')

            </div>

        </div>
    </div>

@endsection
