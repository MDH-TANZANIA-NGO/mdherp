<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

trait HireRequisitionJobDatatable
{
    public function applicationDatatable(){
        return DataTables::of($this->hire_requisition_jobs->getJobs())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.job.application', $query->uuid).'">View Applicants</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
