<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Ticket Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ticket_id', 'Ticket Id:') !!}
    {!! Form::select('ticket_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>
