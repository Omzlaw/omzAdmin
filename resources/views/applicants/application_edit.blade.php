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
    {{ __('Edit Application') }}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Application</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($applicant, ['route' => ['applicants.update', $applicant->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('applicants.application_fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('applicants.dashboard') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>

        <div class="card">

            @include('flash::message')

            {!! Form::open(['route' => 'application.directors', 'method' => 'post', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Directors/Stakeholders</h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#directorsModal">
                                    Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="directorsModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add a new Director
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row d-flex align-items-end">

                                                    {{ Form::hidden('applicant_id', $applicant->id) }}
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
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="directors-table"
                                                class="text-nowrap table table-striped table-bordered">
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
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('applicants.dashboard') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>




    <form method="POST" action="{{ route('operatorDirectors.index') }}" accept-charset="UTF-8" id="deleteForm">
        @csrf

    </form>



    {{-- <script>
        window.onload = function() {

            $('.repeater').repeater({
                // (Optional)
                // start with an empty list of repeaters. Set your first (and only)
                // "data-repeater-item" with style="display:none;" and pass the
                // following configuration flag
                initEmpty: true,
                // (Optional)
                // "defaultValues" sets the values of added items.  The keys of
                // defaultValues refer to the value of the input's name attribute.
                // If a default value is not specified for an input, then it will
                // have its value cleared.
                defaultValues: {
                    'text-input': ''
                },
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function() {
                    $(this).slideDown();
                },
                // (Optional)
                // "hide" is called when a user clicks on a data-repeater-delete
                // element.  The item is still visible.  "hide" is passed a function
                // as its first argument which will properly remove the item.
                // "hide" allows for a confirmation step, to send a delete request
                // to the server, etc.  If a hide callback is not given the item
                // will be deleted.
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                // (Optional)
                // You can use this if you need to manually re-index the list
                // for example if you are using a drag and drop library to reorder
                // list items.
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            });
        }
    </script> --}}

    <script>
        function deleteAction(id, parentId) {
            let route = $('#deleteForm').attr('action') + '/' + id + '/' + parentId;
            route = route.replace('operatorDirectors', 'applicants_directors_destroy');
            $('#deleteForm').attr('action', route);
            if (confirm('Are you sure?')) {
                $('#deleteForm').submit();
            }
        }

        function editAction(id, parentId) {
            let route = $('#deleteForm').attr('action') + '/' + id + '/' + parentId;
            route = route.replace('operatorDirectors', 'applicants_director_edit');
            window.location = route;
        }

        window.onload = function() {
            $('#directors-table').DataTable({
                data: <?php echo $directors; ?>,
                columns: [{
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
                    {
                        "targets": -1,
                        "data": null,
                        render: function(data, type, row) {
                            return `<a title='Edit' href="#" onclick='editAction(${row.id}, {{ $applicant->id }})' class='btn btn-default btn-xs'><i class='far fa-edit'></i></a> <a onclick='deleteAction(${row.id}, {{ $applicant->id }})' title='Delete' href='#' class='btn btn-danger btn-xs'><i class='far fa-trash-alt'></i></a>`
                        }
                    }
                ]
            });
        }
    </script>

    @push('third_party_scripts')
        @include('layouts.datatables_js')
    @endpush
@endsection
