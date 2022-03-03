<?php

namespace App\Http\Controllers\Web\Timesheet\Traits;

use Yajra\DataTables\DataTables;

trait TimesheetDatatable
{
    public function AccessProcessingDatatable(){
        return DataTables::of($this->timesheets->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  'Not Approved';
                return $query->wf_done_date->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public  function AccessRejectedDatatable(){
        return Datatables::of($this->timesheets->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('wf_done_date', function ($query) {
               if ($query->wf_done_date == null)
                   return  "<span class='badge-danger'>Not Approved</span>>";
                return $query->wf_done_date->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessAprovedDatatable(){
        return DataTables::of($this->timesheets->getAccessApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('wf_done_date', function ($query) {
                return $query->wf_done_date->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
