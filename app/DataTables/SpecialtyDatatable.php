<?php

namespace App\DataTables;

use App\Models\Specialty;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SpecialtyDatatable extends DataTable
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
            ->editColumn('name', '{{Str::limit($name, 100)}}')
            ->editColumn('name_ar', '{{Str::limit($name_ar, 100)}}')
            ->addColumn('checkbox', 'dashboard.Specialty.btn.checkbox')
            ->addColumn('action', 'dashboard.Specialty.btn.action')
            ->rawColumns(['checkbox', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Specialty::query()->select("specialties.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Specialties-table')
            ->columns($this->getColumns())
            ->dom('Bfrtip')
            ->parameters([
                'buttons'      => [
                    'pageLength',
                    //old way
                    [
                        'text' =>
                        '<i class="fa fa-trash"></i> ' . __('Delete All'),
                        'className' => 'dt-button buttons-collection delBtn buttons-page-length'
                    ],
                    [
                        "extend" => 'collection',
                        "text" => __("Export"),
                        "buttons" => ['csv', 'excel', 'print']
                    ],
                ],
                'lengthMenu' =>
                [
                    [10, 25, 50, -1],
                    ['10 ' . __('rows'), '25 ' . __('rows'), '50 ' . __('rows'), __('Show all')]
                ],
                'language' => datatable_lang(),

            ])
            ->minifiedAjax()
            ->orderBy(1)
            ->search([]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            [
                'name' => "checkbox",
                'data' => "checkbox",
                'title' =>
                "
                <label class='checkbox checkbox-single'>
                    <input type='checkbox'class='check_all' onclick='check_all()'/>
                    <span></span>
                </label>
                ",
                "exportable" => false,
                "printable" => false,
                "orderable" => false,
                "searchable" => false,
            ],
            Column::make('id'),
            Column::make('name')
                ->title(__('Specialty Name(ENG)')),
            Column::make('name_ar')
                ->title(__('Specialty Name(AR)')),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(120)
                ->addClass('text-center')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Governorates_' . date('YmdHis');
    }
}
