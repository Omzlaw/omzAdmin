<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $gamesPlayed->id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $gamesPlayed->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $gamesPlayed->updated_at }}</p>
</div>

<!-- Operator Id Field -->
<div class="col-sm-12">
    {!! Form::label('operator_id', 'Operator Id:') !!}
    <p>{{ $gamesPlayed->operator_id }}</p>
</div>

<!-- Token Field -->
<div class="col-sm-12">
    {!! Form::label('token', 'Token:') !!}
    <p>{{ $gamesPlayed->token }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $gamesPlayed->status }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $gamesPlayed->amount }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $gamesPlayed->type }}</p>
</div>

<!-- Scheme Field -->
<div class="col-sm-12">
    {!! Form::label('scheme', 'Scheme:') !!}
    <p>{{ $gamesPlayed->scheme }}</p>
</div>

