@extends('layouts.app')

@section('page-title')
    {{ __("Applicant's Dashboard") }}
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Applicant</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="">
            <div class="">
                <div class=" row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div
                    class="small-box @if ($applicant->application_status == 1)
                            bg-warning

                        @elseif ($applicant->application_status == 2)
                            bg-success
                        @else
                            bg-danger
                            
                        @endif">
                    <div class="inner">
                        <h3 class="text-white">
                            {{ get_enum_value('enum_application_status', $applicant->application_status) }}</h3>

                        <p class="text-white">Application Status</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    @if ($applicant->final_submission != 1)
                        <a href="{{ route('application.edit', $applicant->id) }}"
                            class="small-box-footer text-white">Continue
                            <i class="fas fa-arrow-circle-right text-white"></i></a>
                    @else
                        <a href="{{ route('application.show', $applicant->id) }}" class="small-box-footer text-white">View
                            Application
                            <i class="fas fa-arrow-circle-right text-white"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3 class="text-white">
                            @if ($applicant->final_submission == 1)
                                Completed
                            @else
                                Incomplete
                            @endif
                        </h3>

                        <p class="text-white">Submission Status</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <div class="text-center">
                        {!! Form::open(['route' => ['applicants.final_submission', $applicant->id], 'method' => 'post']) !!}

                        @if ($applicant->final_submission == 1)
                            Submitted
                        @else
                            {!! Form::button('Submit', [
    'type' => 'submit',
    'class' => 'btn btn-success btn-xs',
    'onclick' => "return confirm('Are you sure? Please ensure that you have filled out your details completely. Once you submit you can not edit your application')",
    'title' => 'Submit',
]) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    <div class="pt-5">

        <table class="table table-striped table-bordered">
            <col width='40%'>
            <col width='60%'>
            <tbody>
                <tr>
                    <th scope="col">Name</th>
                    <td>{{ $applicant->name }}</td>
                </tr>
                <tr>
                    <th scope="col">RCN</th>
                    <td>{{ $applicant->RC_number }}</td>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <td>{{ $applicant->email }}</td>
                </tr>
                <tr>
                    <th scope="col">Phone</th>
                    <td>{{ $applicant->phone }}</td>
                </tr>
                <tr>
                    <th scope="col">Address</th>
                    <td>{{ $applicant->address }}</td>
                </tr>
                <tr>
                    <th scope="col">Website</th>
                    <td>{{ $applicant->website }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
