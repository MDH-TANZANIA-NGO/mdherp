<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\DataTables;

trait HrHireRequisitionJobApplicantRequestDatatable
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function ProcessingDatatable()
    {
        return DataTables::of($this->hr_hire_job_app_requests->getProcessing())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_applicant_request.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ReturnedForModificationDatatable()
    {
        return DataTables::of($this->hr_hire_job_app_requests->getReturnedForModification())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_applicant_request.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ApprovedDatatable()
    {
        return DataTables::of($this->hr_hire_job_app_requests->getApproved())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_applicant_request.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}