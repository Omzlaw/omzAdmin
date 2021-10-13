<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $broadcast->id }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $broadcast->code }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $broadcast->subject }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $broadcast->message }}</p>
</div>

<!-- Date Start Field -->
<div class="col-sm-12">
    {!! Form::label('date_start', 'Date Start:') !!}
    <p>{{ $broadcast->date_start }}</p>
</div>

<!-- Date End Field -->
<div class="col-sm-12">
    {!! Form::label('date_end', 'Date End:') !!}
    <p>{{ $broadcast->date_end }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $broadcast->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $broadcast->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $broadcast->updated_at }}</p>
</div>

