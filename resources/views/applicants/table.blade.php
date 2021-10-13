@section('third_party_stylesheets')
    @include('layouts.datatables_css')
@endsection

<style>
    td {
        text-align: center!important;
    }
</style>

<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'class' => 'text-nowrap table table-striped table-bordered']) !!}
</div>

@push('third_party_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush

