<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>

<!-- Sent By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sent_by', 'Sent By:') !!}
    {!! Form::text('sent_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Received By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('received_by', 'Received By:') !!}
    {!! Form::text('received_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Read Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_read', 'Is Read', ['class' => 'form-check-label']) !!}
    <label class="form-check">
        {!! Form::radio('is_read', "1", null, ['class' => 'form-check-input']) !!} Yes
    </label>

    <label class="form-check">
        {!! Form::radio('is_read', "0", null, ['class' => 'form-check-input']) !!} No
    </label>

</div>


<!-- Sender Delete Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sender_delete', 'Sender Delete', ['class' => 'form-check-label']) !!}
    <label class="form-check">
        {!! Form::radio('sender_delete', "1", null, ['class' => 'form-check-input']) !!} Yes
    </label>

    <label class="form-check">
        {!! Form::radio('sender_delete', "0", null, ['class' => 'form-check-input']) !!} No
    </label>

</div>


<!-- Receiver Delete Field -->
<div class="form-group col-sm-12">
    {!! Form::label('receiver_delete', 'Receiver Delete', ['class' => 'form-check-label']) !!}
    <label class="form-check">
        {!! Form::radio('receiver_delete', "1", null, ['class' => 'form-check-input']) !!} Yes
    </label>

    <label class="form-check">
        {!! Form::radio('receiver_delete', "0", null, ['class' => 'form-check-input']) !!} No
    </label>

</div>
