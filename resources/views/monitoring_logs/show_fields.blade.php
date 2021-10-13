<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $monitoringLog->id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $monitoringLog->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $monitoringLog->updated_at }}</p>
</div>

<!-- Operator Field -->
<div class="col-sm-12">
    {!! Form::label('operator', 'Operator:') !!}
    <p>{{ $monitoringLog->operator }}</p>
</div>

<!-- Operator Id Field -->
<div class="col-sm-12">
    {!! Form::label('operator_id', 'Operator Id:') !!}
    <p>{{ $monitoringLog->operator_id }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', 'Website:') !!}
    <p>{{ $monitoringLog->website }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $monitoringLog->status }}</p>
</div>

