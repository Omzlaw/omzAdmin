<!-- Order No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_no', 'Order No:') !!}
    {!! Form::text('order_no', null, ['class' => 'form-control']) !!}
</div>

<!-- License Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('license_type_id', 'License Type Id:') !!}
    {!! Form::text('license_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Due Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('due_date', 'Due Date:') !!}
    {!! Form::text('due_date', null, ['class' => 'form-control','id'=>'due_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#due_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Date Last Paid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_last_paid', 'Date Last Paid:') !!}
    {!! Form::text('date_last_paid', null, ['class' => 'form-control','id'=>'date_last_paid']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_last_paid').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['-1' => 'Select', '1' => 'Active', '0' => ' Inactive'], null, ['class' => 'form-control custom-select']) !!}
</div>
