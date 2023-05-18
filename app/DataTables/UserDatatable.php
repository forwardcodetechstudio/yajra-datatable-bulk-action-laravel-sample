<?php

namespace App\DataTables;

use App\Models\User;
use App\Exports\UsersExport;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    public $actions;

    function __construct()
    {
        $this->actions = $this->bulk_actions();
    }

    public function bulk_actions()
    {
        return view('partials.bulk-actions', [
            'bulk_actions' => [
                [
                    'value' => 'delete',
                    'label' => 'Delete',
                    'url' => route('user.deleteSelected'),
                    'method' => 'DELETE',
                    'confirm-button-label' => 'Delete',
                    'confirm-message' => 'Are you sure to delete selected records!',
                ],
                [
                    'value' => 'status',
                    'label' => 'Status',
                    'url' => route('user.changeStatusSelected'),
                    'method' => 'POST',
                    'confirm-button-label' => 'Change Status',
                    'confirm-message' => 'Are you sure to change the status of selected records!',
                ],
            ]
        ])->render();
    }

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
            ->addColumn('action', function ($model) {
                return view('partials.table-actions', [
                    'options' => [
                        [
                            'name' => 'Delete ',
                            'url' => route('users.destroy', ['user' => $model->id]),
                            'icon' => 'icon-trash'
                        ],
                    ]
                ])->render();
            })
            ->editColumn('status', function ($model) {
                return ($model->status == 1) ? '<span class="badge badge-pill badge-success p-2">Active</span>' : '<span class="badge badge-pill badge-dark p-2">Inactive</span>';
            })
            ->editColumn('description_1', function ($model) {
                return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis ut ipsum ac posuere.";
            })
            ->editColumn('description_2', function ($model) {
                return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis ut ipsum ac posuere.";
            })
            ->editColumn('description_3', function ($model) {
                return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis ut ipsum ac posuere.";
            })
            ->editColumn('description_4', function ($model) {
                return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis ut ipsum ac posuere.";
            })
            ->editColumn('description_5', function ($model) {
                return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis ut ipsum ac posuere.";
            })
            ->editColumn('delete',  function ($model) {
                return view('partials.delete-switch', [
                    'id' => $model->id
                ])->render();
            })
            ->setRowId(function ($model) {
                return $model->id;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $new_query = $model->newQuery();

        if (isset(request()->selected_rows)) {
            $new_query = $new_query->whereIn('id', explode(",", request('selected_rows')));
        }

        return $new_query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('User_datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->fixedColumnsLeftColumns(2)
            ->fixedColumnsRightColumns(1)
            ->dom("<'bulk-actions-container'><'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-7'B><'col-sm-12 col-md-3'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 text-right col-md-7'p>>",)
            ->orderBy(2, 'asc')
            ->pageLength(10)
            ->lengthMenu([[10, 25, 50, 100], [10, 25, 50, 100]])
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )->parameters([
                'drawCallback' => "function(){
                $('.bulk-actions-container').html(`$this->actions`);
                $('th.delete-all').html(\"<input type='checkbox' id='delete-all-records' class='js-delete-switch'>\");
                initSingleCheckboxes();
                initDeleteAllCheckbox();
                initActionJs();
            }",
                'rowCallback' => "function(row, data){
                if($.inArray(data.DT_RowId, selected_rows) !== -1 ) {
                    $(row).find(':checkbox').trigger('click');
                }
            }"
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
            Column::computed('delete')->exportable(false)->printable(false)->addClass('text-center delete-all'),
            Column::computed('action')->exportable(false)->printable(false)->addClass('text-center'),
            Column::make('id')->addClass('text-center'),
            Column::make('name'),
            Column::make('email'),
            Column::make('email_verified_at'),
            Column::make('description_1'),
            Column::make('description_2'),
            Column::make('description_3'),
            Column::make('description_4'),
            Column::make('description_5'),
            Column::make('updated_at'),
            Column::computed('status')->addClass('text-center'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }

    // public function excel()
    // {
    //     return Excel::download(new UsersExport, $this->filename() . '.xlsx');
    // }
}
