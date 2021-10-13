<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Rc Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('RC_number', 'RC Number:') !!}
    {!! Form::text('RC_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logo', 'Logo:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('logo', ['class' => 'custom-file-input']) !!}
            {!! Form::label('logo', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- No Of Shareholders Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_shareholders', 'No Of Shareholders:') !!}
    {!! Form::number('no_of_shareholders', null, ['class' => 'form-control']) !!}
</div>


<!-- No Of Directors Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_directors', 'No Of Directors:') !!}
    {!! Form::number('no_of_directors', null, ['class' => 'form-control']) !!}
</div>


<!-- Has Previously Applied Field -->
<div class="form-group col-sm-6">
    {!! Form::label('has_previously_applied', 'Has Previously Applied:') !!}
    {!! Form::select('has_previously_applied', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Has Pending Application Field -->
<div class="form-group col-sm-6">
    {!! Form::label('has_pending_application', 'Has Pending Application:') !!}
    {!! Form::select('has_pending_application', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Prev Application Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('prev_application_details', 'Prev Application Details:') !!}
    {!! Form::textarea('prev_application_details', null, ['class' => 'form-control']) !!}
</div>



<!-- 'bootstrap / Toggle Switch Accept Terms Field' -->
<div class="form-group col-sm-12">
    {!! Form::label('accept_terms', 'Accept Terms:') !!}
    {!! Form::hidden('accept_terms', 0) !!}
    {!! Form::checkbox('accept_terms', 1, null, ['data-bootstrap-switch']) !!}
</div>


<!-- Application Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('application_status', 'Application Status:') !!}
    {!! Form::select('application_status', enum_application_status(), null, ['class' => 'form-control custom-select']) !!}
</div>


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Directors/Stakeholders</h3>
        </div>

        <div class="card-body">
            <div class="repeater">
                <div data-repeater-list="directors">

                    <div data-repeater-item class="mt-3">
                        <div class="row d-flex align-items-end">

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
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_director_shareholder', 'Is Director Shareholder:') !!}
                                {!! Form::select('is_director_shareholder', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                            </div>


                            <!-- Is Politician Id Field -->
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_politician', 'Is Politician:') !!}
                                {!! Form::select('is_politician', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                            </div>

                            <!-- Has been Convicted  Field -->
                            <div class="form-group col-sm-3">
                                {!! Form::label('has_been_convicted', 'Has been Convicted:') !!}
                                {!! Form::select('has_been_convicted', enum_yes_no(), null, ['class' => 'form-control custom-select']) !!}
                            </div>


                            <!-- Conviction Details Field -->
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('conviction_details', 'Conviction Details:') !!}
                                {!! Form::textarea('conviction_details', null, ['class' => 'form-control']) !!}
                            </div>


                            <!-- Shareholder Type Field -->
                            <div class="form-group col-sm-3">
                                {!! Form::label('shareholder_type', 'Shareholder Type:') !!}
                                {!! Form::select('shareholder_type', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
                            </div>


                            <!-- Number Of Shares Field -->
                            <div class="form-group col-sm-3">
                                {!! Form::label('number_of_shares', 'Number Of Shares:') !!}
                                {!! Form::number('number_of_shares', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-2 col-12 mb-50">
                                <div class="form-group">
                                    <input class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                        type="button" value="Delete">
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12">
                        <input class="btn btn-icon btn-primary" data-repeater-create type="button" value="Add" />
                    </div>
                </div>
            </div>



        </div>


    </div>

</div>

<!-- Documents Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documents', 'Documents:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('documents', ['class' => 'custom-file-input', 'multiple' => true]) !!}
            {!! Form::label('documents', 'Choose files', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<script>
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
</script>
