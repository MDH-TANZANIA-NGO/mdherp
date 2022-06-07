<?php
namespace App\Http\Controllers\Web\Reports\Traits;

use Yajra\DataTables\Facades\DataTables;

trait TimesheetReportDatatable
{

    public function getSubmittedTimesheets(){
        return DataTables::of($this->timesheets->getSubmittedTimesheets())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  "Not Approved";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getApprovedTimesheets(){
        return DataTables::of($this->timesheets->getApprovedTimesheets())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                $date = strtotime($query->wf_done_date);
                return date('d/m/Y', $date);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getRejectedTimesheets(){
        return DataTables::of($this->timesheets->getRejectedTimesheets())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  'Not Approved';
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
