@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Profile</h1>
                </div>
                <div class="col-sm-6">
                    @if (!Auth::user()->hasRole('superadministrator'))
                        <a class="btn btn-default float-right" href="{{ route('users.edit', $user->id) }}">
                            Edit
                        </a>
                    @else
                        <a class="btn btn-default float-right" href="{{ route('users.index') }}">
                            Back
                        </a>
                        <a class="btn btn-default float-right mr-3" href="{{ route('users.edit', $user->id) }}">
                            Edit
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                @if (isset(Auth::user()->profile_picture_path))
                                <img height="100" width="100" src="{{ asset(Auth::user()->profile_picture_path) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                                @else
                                <img height="100" width="100" src="{{ asset('images/logo.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                                @endif
                            </div>
                            <span class="mt-3">{{ $user->email }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                @include('users.show_fields')
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
