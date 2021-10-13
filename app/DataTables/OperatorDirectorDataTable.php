<?php

namespace App\DataTables;

use App\Models\OperatorDirector;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class OperatorDirectorDataTable extends DataTable
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


        return $dataTable->addColumn('action', 'operator_directors.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OperatorDirector $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OperatorDirector $model)
    {
        $user = Auth::user();
        if($user->hasRole('operator')){
            return $model
            ->where('operator_id', $user->operator->user_id)
            ->where('operator_id', '!=', null);
        }
        return $model->where('operator_id', '!=', null);
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
            'first_name',
            'last_name',
            'middle_name',
            'phone_number',
            'email',
            'other_phone_number',
            'is_director_shareholder',
            'is_politician',
            'has_been_convicted',
            'conviction_details',
            'operator_id',
            'applicant_id',
            'shareholder_type',
            'number_of_shares'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'operator_directors_datatable_' . time();
    }
}
