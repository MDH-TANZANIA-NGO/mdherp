<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\DataTables;

trait HireRequisitionJobDatatable
{
    public function applicationDatatable(){
        return DataTables::of($this->hire_requisition_jobs->getJobs())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('education_level', function ($query) {
                return code_value()->query()->where('id',$query->education_level)->first()->name;
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.job.show', $query->uuid).'">View Applicants</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
