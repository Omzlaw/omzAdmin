<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $ticket->id }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $ticket->subject }}</p>
</div>

<!-- Ticket Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('ticket_type_id', 'Ticket Type Id:') !!}
    <p>{{ $ticket->ticket_type_id }}</p>
</div>

<!-- Complain Field -->
<div class="col-sm-12">
    {!! Form::label('complain', 'Complain:') !!}
    <p>{{ $ticket->complain }}</p>
</div>

<!-- File Upoad Field -->
<div class="col-sm-12">
    {!! Form::label('file_upoad', 'File Upoad:') !!}
    <p>{{ $ticket->file_upoad }}</p>
</div>

<!-- Assigned To Field -->
<div class="col-sm-12">
    {!! Form::label('assigned_to', 'Assigned To:') !!}
    <p>{{ $ticket->assigned_to }}</p>
</div>

<!-- Operator Id Field -->
<div class="col-sm-12">
    {!! Form::label('operator_id', 'Operator Id:') !!}
    <p>{{ $ticket->operator_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $ticket->status }}</p>
</div>

<!-- Action Taken Field -->
<div class="col-sm-12">
    {!! Form::label('action_taken', 'Action Taken:') !!}
    <p>{{ $ticket->action_taken }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $ticket->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $ticket->updated_at }}</p>
</div>

