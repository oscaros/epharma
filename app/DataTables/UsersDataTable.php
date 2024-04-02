<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'users.action')
            ->editColumn('entity.name', function($query) {
                return $query->entity->name ?? '-';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'name', 'email' , 'entity_id' );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('usersDataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                "processing" => true,
                "autoWidth" => false,
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
            // ['data' => 'id',  'title' => 'ID'],
            ['data'  => 'name', 'title' => 'Name'],

            ['data' => 'email',  'title' => 'Email'],
            // ['data' => 'entities.name', 'name' => 'entity_id', 'title' => 'Works At'],
            ['data' => 'entity.name', 'name' => 'entity.name', 'title' => 'Business Name'],
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}

