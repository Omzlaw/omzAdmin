<div class="col-sm6">
    <!-- Name Field -->
    <tr class="">
        <th>{!! Form::label('name', 'Name:') !!}</th>
        <td>{{ $applicant->name }}</td>
    </tr>

    <!-- Rc Number Field -->
    <tr class="">
        <th>{!! Form::label('RC_number', 'RC Number:') !!}</th>
        <td>{{ $applicant->RC_number }}</td>
    </tr>

    <!-- Phone Field -->
    <tr class="">
        <th>{!! Form::label('phone', 'Phone:') !!}</th>
        <td>{{ $applicant->phone }}</td>
    </tr>

    <!-- Address Field -->
    <tr class="">
        <th>{!! Form::label('address', 'Address:') !!}</th>
        <td>{{ $applicant->address }}</td>
    </tr>


    <!-- Website Field -->
    <tr class="">
        <th>{!! Form::label('website', 'Website:') !!}</th>
        <td>{{ $applicant->website }}</td>
    </tr>


    <!-- Email Field -->
    <tr class="">
        <th>{!! Form::label('email', 'Email:') !!}</th>
        <td>{{ $applicant->email }}</td>
    </tr>

    <!-- No Of Shareholders Field -->
    <tr class="">
        <th>{!! Form::label('no_of_shareholders', 'No Of Shareholders:') !!}</th>
        <td>{{ $applicant->no_of_shareholders }}</td>
    </tr>

</div>

