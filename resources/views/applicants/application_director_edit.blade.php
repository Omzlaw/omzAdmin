@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Operator Director</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($operatorDirector, ['route' => ['applicants_director_update', [$operatorDirector->id, $applicant_id]], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    {{ Form::hidden('applicant_id', $applicant_id) }}
                    <!-- First Name Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('first_name', 'First Name:') !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Last Name Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('last_name', 'Last Name:') !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Middle Name Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('middle_name', 'Middle Name:') !!}
                        {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Phone Number Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('phone_number', 'Phone Number:') !!}
                        {!! Form::number('phone_number', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Other Phone Number Field -->
                    <div class="form-group col-sm-3">
                        {!! Form::label('other_phone_number', 'Other Phone Number:') !!}
                        {!! Form::number('other_phone_number', null, ['class' => 'form-control']) !!}
                    </div>


                    <!-- Is Director Shareholder Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('is_director_shareholder', 'Is Director Shareholder:') !!}
                        {!! Form::select('is_director_shareholder', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                    </div>


                    <!-- Is Politician Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('is_politician', 'Is Politician:') !!}
                        {!! Form::select('is_politician', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                    </div>

                    <!-- Has been Convicted  Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('has_been_convicted', 'Has been Convicted:') !!}
                        {!! Form::select('has_been_convicted', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                    </div>


                    <!-- Conviction Details Field -->
                    <div class="form-group col-sm-12 col-lg-12">
                        {!! Form::label('conviction_details', 'Conviction Details:') !!}
                        {!! Form::textarea('conviction_details', null, ['class' => 'form-control']) !!}
                    </div>


                    <!-- Shareholder Type Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('shareholder_type', 'Shareholder Type:') !!}
                        {!! Form::select('shareholder_type', enum_shareholder_type(), null, ['class' => 'form-control custom-select']) !!}
                    </div>


                    <!-- Number Of Shares Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('number_of_shares', 'Number Of Shares:') !!}
                        {!! Form::number('number_of_shares', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('application.edit', $applicant_id) }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
