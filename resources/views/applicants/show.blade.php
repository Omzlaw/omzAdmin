<?php

$directors = $applicant->directors->map(function ($item) {
    $item->is_director_shareholder = get_enum_value('enum_yes_no', $item->is_director_shareholder);
    $item->is_politician = get_enum_value('enum_yes_no', $item->is_politician);
    $item->has_been_convicted = get_enum_value('enum_yes_no', $item->has_been_convicted);
    $item->shareholder_type = get_enum_value('enum_shareholder_type', $item->shareholder_type);
    
    return $item;
});
?>

@extends('layouts.app')

@section('page-title')
    {{ __('Applicant Details') }}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Applicant Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('applicants.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <!-- Logo Field -->
                <div class="col-sm-12 mb-3">
                    {{-- <th>{!! Form::label('logo', 'Logo:') !!}</th> --}}
                    @if (isset($applicant->logo))
                        <img height="100" width="100" src="{{ asset($applicant->logo) }}" class="img-circle" />
                    @else
                        <img src="{{ asset('images/logo.png') }}" class="img-circle" />
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-default table-striped">
                            @include('applicants.show_fields')

                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-default table-striped">
                            @include('applicants.show_fields2')

                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Director Details</h3>
                        <div class="table-responsive">
                            <table id="directors-table" class="text-nowrap table table-striped table-bordered">
                                <thead>
                                    <thead>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Other Phone Number</th>
                                        <th>Shareholder</th>
                                        <th>Politician</th>
                                        <th>Convicted</th>
                                        <th>Conviction Details</th>
                                        <th>Shareholder type</th>
                                        <th>Number of Shares</th>
                                        <th colspan="2">Action</th>
                                    </thead>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = function() {
            $('#directors-table').DataTable({
                data: <?php echo $directors; ?>,
                columns: [
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'middle_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'phone_number'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'other_phone_number'
                    },
                    {
                        data: 'is_director_shareholder'
                    },
                    {
                        data: 'is_politician'
                    },
                    {
                        data: 'has_been_convicted'
                    },
                    {
                        data: 'conviction_details'
                    },
                    {
                        data: 'shareholder_type'
                    },
                    {
                        data: 'number_of_shares'
                    },
                ]
            });
        }
    </script>

    @push('third_party_scripts')
        @include('layouts.datatables_js')
    @endpush

@endsection
