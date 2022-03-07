<?php

namespace App\DataTables;

use App\Models\Doctor;
use App\Models\Radiology;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RadiologyDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $db=datatables()
        ->eloquent($query)
        ->editColumn('desc', '{{ $desc }}')
        ->editColumn('doctor.user', function($q){
            if($q->doctor){
                return "<a href=".route("dashboard.doctor.edit",["doctor"=> $q->doctor->id]).'>'. $q->doctor->user->first_name. " ". $q->doctor->user->last_name.'</a>';
            }


        })
        ->editColumn('patient.user', function($q){
            if($q->patient){
                return "<a href=".route("dashboard.patient.edit",["patient"=> $q->patient->id]).'>'.$q->patient->user->first_name. " ". $q->patient->user->last_name.'</a>';
            }


        })
        ->addColumn('checkbox', 'dashboard.Radiology.btn.checkbox')
        ->addColumn('action', 'dashboard.Radiology.btn.action')
        ->rawColumns(['checkbox', 'action','doctor.user','patient.user']);

        return $db;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Radiology::query()->with(['doctor.user','patient.user','center'])->select("radiologies.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Radiology-table')
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
            Column::make('desc')->title(__("Description")),
            Column::make('patient.user')->title(__("Patient")),
            Column::make('doctor.user')->title(__("Doctor")),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(200)
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
        return 'Radiologies' . date('YmdHis');
    }
}
