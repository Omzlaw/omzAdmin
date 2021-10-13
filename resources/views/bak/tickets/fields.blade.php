<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Ticket Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ticket_type_id', 'Ticket Type Id:') !!}
    {!! Form::text('ticket_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Complain Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('complain', 'Complain:') !!}
    {!! Form::textarea('complain', null, ['class' => 'form-control']) !!}
</div>

<!-- File Upoad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_upoad', 'File Upoad:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('file_upoad', ['class' => 'custom-file-input']) !!}
            {!! Form::label('file_upoad', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'Open', '1' => ' Closed'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Action Taken Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('action_taken', 'Action Taken:') !!}
    {!! Form::textarea('action_taken', null, ['class' => 'form-control']) !!}
</div>