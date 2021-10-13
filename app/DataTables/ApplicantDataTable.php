<?php

namespace App\DataTables;

use App\Models\Applicant;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ApplicantDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('logo', 'applicants.logo')
        ->editColumn('logo', 'applicants.logo')
        ->editColumn('application_status', 'applicants.application_status')
        ->addColumn('action', 'applicants.datatables_actions')
        ->rawColumns(['logo', 'application_status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Applicant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Applicant $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'lBfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'colvis', 'className' => 'btn btn-default btn-sm no-corner',]
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'id',
            'logo',
            'name',
            'RC_number',
            'application_status',
            'address',
            'phone',
            'website',
            'email',
            // 'no_of_shareholders',
            // 'shareholders_details',
            // 'no_of_directors',
            // 'directors_details',
            // 'has_previously_applied',
            // 'owners_convicted',
            // 'conviction_details',
            // 'Is_director_politician',
            // 'has_pending_application',
            // 'prev_application_details',
            // 'is_shareholder_politician',
            // 'accept_terms',
            // 'created_at' => ['searchable' => false],
            // 'updated_at' => ['searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'applicants_datatable_' . time();
    }
}
