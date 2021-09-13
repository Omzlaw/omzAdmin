<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $activityLog->type }}</p>
</div>

<!-- Time Field -->
<div class="col-sm-12">
    {!! Form::label('time', 'Time:') !!}
    <p>{{ $activityLog->time }}</p>
</div>

<!-- Activity By Field -->
<div class="col-sm-12">
    {!! Form::label('activity_by', 'Activity By:') !!}

    @if (isset($activityLog->activity_by))
        @if ($activityLog->activity_by == Auth::user()->id)
            <p>You</p>
        @else
            <p>{{ $activityLog->activityBy->name . ', ' . $activityLog->activityBy->email }}</p>
        @endif
    @endif


</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $activityLog->description }}</p>
</div>
