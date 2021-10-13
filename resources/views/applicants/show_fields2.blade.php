<div class="col-sm-6">
    <!-- Has Previously Applied Field -->
    <tr class="">
        <th>{!! Form::label('has_previously_applied', 'Has Previously Applied:') !!}</th>
        <td>{{ get_enum_value('enum_yes_no', $applicant->has_previously_applied) }}</td>
    </tr>

    <!-- Has Pending Application Field -->
    <tr class="">
        <th>{!! Form::label('has_pending_application', 'Has Pending Application:') !!}</th>
        <td>{{ get_enum_value('enum_yes_no', $applicant->has_pending_application) }}</td>
    </tr>



    <!-- No Of Directors Field -->
    <tr class="">
        <th>{!! Form::label('no_of_directors', 'No Of Directors:') !!}</th>
        <td>{{ $applicant->no_of_directors }}</td>
    </tr>



    <!-- Conviction Details Field -->
    <tr class="">
        <th>{!! Form::label('conviction_details', 'Conviction Details:') !!}</th>
        <td>{{ $applicant->conviction_details }}</td>
    </tr>




    <!-- Prev Application Details Field -->
    <tr class="">
        <th>{!! Form::label('prev_application_details', 'Prev Application Details:') !!}</th>
        <td>{{ $applicant->prev_application_details }}</td>
    </tr>


    <!-- Accept Terms Field -->
    <tr class="">
        <th>{!! Form::label('accept_terms', 'Accept Terms:') !!}</th>
        <td>{{ get_enum_value('enum_yes_no', $applicant->accept_terms) }}</td>
    </tr>

    <!-- Application Status Field -->
    <tr class="">
        <th>{!! Form::label('application_status', 'Application Status:') !!}</th>
        <td>{{ get_enum_value('enum_application_status', $applicant->application_status) }}</td>
    </tr>


</div>