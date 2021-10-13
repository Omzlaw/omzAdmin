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

<!-- Date Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_start', 'Date Start:') !!}
    {!! Form::date('date_start', null, ['class' => 'form-control','id'=>'date_start']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_start').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Date End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_end', 'Date End:') !!}
    {!! Form::date('date_end', null, ['class' => 'form-control','id'=>'date_end']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_end').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', enum_status(), null, ['class' => 'form-control']) !!}
</div>