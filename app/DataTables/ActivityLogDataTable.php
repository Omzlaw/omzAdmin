<?php

namespace App\DataTables;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable
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
        $user = Auth::user();
        return $dataTable
        ->addColumn('activity_by', function ($row) use ($user) {
            if(isset($row->activity_by)){
                if($row->activity_by == $user->id){
                    return 'You';
                }
                else {
                    return $row->activityBy->name . ', ' . $row->activityBy->email;
                }
            }
        })
        ->addColumn('action', 'activity_logs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityLog $model)
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
            'type',
            'description',
            'activity_by',
            'time',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'activity_logs_datatable_' . time();
    }
}
