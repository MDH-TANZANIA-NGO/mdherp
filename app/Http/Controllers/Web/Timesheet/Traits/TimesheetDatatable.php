<?php

namespace App\Http\Controllers\Web\Timesheet\Traits;

use Yajra\DataTables\DataTables;

trait TimesheetDatatable
{
    public function AccessProcessingDatatable(){
        return DataTables::of($this->timesheets->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  'Not Approved';
                return $query->wf_done_dateformat('d/m/Y');
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
                return $query->created_at->format('d/m/Y');;
            })
            ->editColumn('wf_done_date', function ($query) {
               if ($query->wf_done_date == null)
                   return  "Not Approved";
                return $query->wf_done_date->format('d/m/Y');
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. '&nbsp' .'<a href="'.route('timesheet.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessApprovedDatatable(){
        return DataTables::of($this->timesheets->getAccessApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->editColumn('wf_done_date', function ($query) {
                return date('Y-m-d', strtotime($query->wf_done_date));
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
