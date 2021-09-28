
<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Time:') !!}
    <p>{{ $notification->created_at->diffForHumans() }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-6">
    {!! Form::label('data', 'Message:') !!}
    <p>{{ $notification->data }}</p>
</div>


