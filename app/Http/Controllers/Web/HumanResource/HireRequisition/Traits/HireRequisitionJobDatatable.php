<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\DataTables;

trait HireRequisitionJobDatatable
{
    /**
     * getJobApplicationWhichHaveShortlistedApplicants
     * @return mixed
     */
    public function applicationDatatable(){
        return DataTables::of($this->hire_requisition_jobs->getJobApplicationsWhichDoesNotHaveShortlisterReport())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('education_level', function ($query) {
                $education_level = code_value()->query()->where('id',$query->education_level)->first();
                return isset($education_level) ? $education_level->name :"";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.job.show', $query->uuid).'">View Applicants</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * getJobApplicationWhichHaveShortlistedApplicants
     * @return mixed
     */
    public function jobApplicationWhichHaveShortlistedApplicantsDatatable(){
        return DataTables::of($this->hire_requisition_jobs->getJobApplicationWhichHaveShortlistedApplicants())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('education_level', function ($query) {
                $education_level = code_value()->query()->where('id',$query->education_level)->first();
                return isset($education_level) ? $education_level->name :"";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.job.show', $query->uuid).'">View shortlited Applicants</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
