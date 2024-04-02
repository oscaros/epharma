<?php 


namespace App\DataTables;

use App\Models\AuditLog;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuditLogsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'audit_logs.action')
            ->rawColumns(['action']);
    }

    public function query(AuditLog $model)
    {
        return $model->newQuery();
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('user_id')->title('User ID'),
            Column::make('description')->title('Description'),
            Column::make('event_type')->title('Event Type'),
            Column::make('business_id')->title('Business ID'),
            Column::make('date')->title('Date'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Actions'),
        ];
    }

    // protected function filename()
    // {
    //     return 'AuditLogs_' . date('YmdHis');
    // }
}
