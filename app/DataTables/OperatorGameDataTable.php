<?php

namespace App\DataTables;

use App\Models\OperatorGame;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class OperatorGameDataTable extends DataTable
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
        

        return $dataTable->addColumn('action', 'operator_games.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OperatorGame $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OperatorGame $model)
    {
        $user = Auth::user();
        if($user->hasRole('operator')){
            return $model->where('operator_id', $user->operator->user_id);
        }
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
          //  'id',
            'operator_id' => ['title' => 'Operator'],
            'name',
            'amount',
            'operator_scheme_id' => ['title' => 'Scheme'],
            'status',
         //   'created_at' => ['searchable' => false],
         //  'updated_at' => ['searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'operator_games_datatable_' . time();
    }
}
