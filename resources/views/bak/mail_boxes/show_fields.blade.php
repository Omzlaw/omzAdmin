<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $mailBox->id }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $mailBox->code }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $mailBox->subject }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $mailBox->message }}</p>
</div>

<!-- Sent By Field -->
<div class="col-sm-12">
    {!! Form::label('sent_by', 'Sent By:') !!}
    <p>{{ $mailBox->sent_by }}</p>
</div>

<!-- Received By Field -->
<div class="col-sm-12">
    {!! Form::label('received_by', 'Received By:') !!}
    <p>{{ $mailBox->received_by }}</p>
</div>

<!-- Is Read Field -->
<div class="col-sm-12">
    {!! Form::label('is_read', 'Is Read:') !!}
    <p>{{ $mailBox->is_read }}</p>
</div>

<!-- Sender Delete Field -->
<div class="col-sm-12">
    {!! Form::label('sender_delete', 'Sender Delete:') !!}
    <p>{{ $mailBox->sender_delete }}</p>
</div>

<!-- Receiver Delete Field -->
<div class="col-sm-12">
    {!! Form::label('receiver_delete', 'Receiver Delete:') !!}
    <p>{{ $mailBox->receiver_delete }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $mailBox->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $mailBox->updated_at }}</p>
</div>

