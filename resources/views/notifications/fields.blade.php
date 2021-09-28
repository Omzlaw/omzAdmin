{{-- <!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Notifiable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notifiable_type', 'Notifiable Type:') !!}
    {!! Form::text('notifiable_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Notifiable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notifiable_id', 'Notifiable Id:') !!}
    {!! Form::number('notifiable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', 'Data:') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>

<!-- Read At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('read_at', 'Read At:') !!}
    {!! Form::text('read_at', null, ['class' => 'form-control','id'=>'read_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#read_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush --}}