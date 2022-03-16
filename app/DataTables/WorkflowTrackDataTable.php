<?php

namespace App\DataTables;

use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Services\DataTable;


class WorkflowTrackDataTable extends DataTable
{

    /**
     * @return \Yajra\Datatables\Engines\BaseEngine
     * @throws \App\Exceptions\GeneralException
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('user_id', function($wf_track) {
                return count($wf_track->user) ? $wf_track->user->username : $wf_track->wfDefinition->designation->name;
            })
            ->editColumn('receive_date', function ($wf_track) {
                return $wf_track->receive_date_formatted;
            })
            ->editColumn('forward_date', function ($wf_track) {
                return !is_null($wf_track->forward_date) ? $wf_track->forward_date_formatted : ' ';
            })
            ->editColumn('status', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->editColumn('wf_definition_id', function ($wf_track) {
                return $wf_track->wfDefinition->level;
            })
            ->addColumn('action', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->addColumn("aging", function ($wf_track) {
                return $wf_track->getAgingDays();
            })

            ->rawColumns(['action','user_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection|mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function query()
    {

        $type = (isset($this->type) ? $this->type : NULL);
        $wfTrack = new WfTrackRepository();
        $query = $wfTrack->getPendingWfTracksForDatatable($this->resource_id, $this->wf_module_group_id, $type);

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        $type = (isset($this->type) ? $this->type : -1);
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('workflow.wf_tracks.get', ['resource_id' => $this->resource_id, 'wf_module_group_id'=>$this->wf_module_group_id, 'type' => $type ]),
                'method' => 'get',
            ])
            ->parameters([
                //'dom' => 'Bfrtip',
                'searching' => true,
                'processing' => true,
                'serverSide' => true,
                'stateSave' => false,
                'paging' => false,
                'info' => false,
                'buttons' => ['reset', 'reload', 'colvis'],
                "drawCallback" => "function () {
                    if ($(this).find('tbody tr').filter(\"[role='row']\").length<=0) {
                       $(this).parent().hide();
                    }
                }",
                'initComplete' => "function () {
                    window.LaravelDataTables['workflow'].buttons().container().insertBefore( '#workflow' );
                    if ($(this).find('tbody tr').filter(\"[role='row']\").length<=0) {
                       $(this).parent().hide();
                    }
                }",

            ]);
    }

    /**
     * 'rowCallback' => "function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
    $('#approve_modal').click(function() {
    alert('this is');
    $('#workflow_modal').modal('show');
    }).hover(function() {
    $(this).css('cursor','pointer');
    }, function() {
    $(this).css('cursor','auto');
    });
    }",
     * //load_workflow_modal(aData['id']);
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'user_id', 'name' => 'user_id', 'title' => trans('label.username'), 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'name' => 'status', 'title' => trans('label.status'), 'orderable' => false, 'searchable' => false],
            ['data' => 'wf_definition_id', 'name' => 'wf_definition_id', 'title' => trans('label.system.workflow.level'), 'orderable' => false, 'searchable' => false],
            ['data' => 'description', 'name' => 'description', 'title' => trans('label.descriptions'), 'orderable' => false, 'searchable' => false],
            ['data' => 'comments', 'name' => 'comments', 'title' => trans('label.comments'), 'orderable' => false, 'searchable' => false],
            ['data' => 'receive_date', 'name' => 'receive_date', 'title' => trans('label.system.workflow.receive_date'), 'orderable' => false, 'searchable' => false, 'visible' => false],
            ['data' => 'forward_date', 'name' => 'forward_date', 'title' => trans('label.system.workflow.forward_date'), 'orderable' => false, 'searchable' => false, 'visible' => false],
            ['data' => 'aging', 'name' => 'aging', 'title' => trans('label.system.workflow.aging_days'), 'orderable' => false, 'searchable' => false],
            ['data' => 'id', 'name' => 'id', 'orderable' => false, 'searchable' => false, 'visible' => false],
//            ['data' => 'option', 'name' => 'option', 'title' => trans('label.action'), 'orderable' => false, 'searchable' => false, 'visible' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'workflowdatatable_' . time();
    }
}
