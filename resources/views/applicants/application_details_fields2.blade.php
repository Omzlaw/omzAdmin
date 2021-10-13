<!-- Email Field -->
<tr class="col-sm-4">
    <th>{!! Form::label('email', 'Email:') !!}</th>
    <td>{{ $applicant->email }}</td>
</tr>

<!-- No Of Shareholders Field -->
<tr class="col-sm-4">
    <th>{!! Form::label('no_of_shareholders', 'No Of Shareholders:') !!}</th>
    <td>{{ $applicant->no_of_shareholders }}</td>
</tr>

<!-- No Of Directors Field -->
<tr class="col-sm-4">
    <th>{!! Form::label('no_of_directors', 'No Of Directors:') !!}</th>
    <td>{{ $applicant->no_of_directors }}</td>
</tr>



<!-- Application Status Field -->
<tr class="col-sm-6">
    <th>{!! Form::label('application_status', 'Application Status:') !!}</th>
    <td>{{ get_enum_value('enum_application_status', $applicant->application_status) }}</td>
</tr>
