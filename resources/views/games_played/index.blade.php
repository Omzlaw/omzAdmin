@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Games Played</h1>
                </div>
                <div class="col-sm-6">
                    {{-- <a class="btn btn-primary float-right"
                       href="{{ route('gamesPlayed.create') }}">
                        Add New
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3">
                @include('games_played.table')

            </div>

        </div>
    </div>

@endsection

