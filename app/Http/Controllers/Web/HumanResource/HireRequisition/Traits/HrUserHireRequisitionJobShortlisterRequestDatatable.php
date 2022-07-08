<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\DataTables;

trait HrUserHireRequisitionJobShortlisterRequestDatatable
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function ProcessingDatatable()
    {
        return DataTables::of($this->job_shortlister_requests->getProcessing())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_shortlister.show', $query->uuid).'">View</a>';
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
        return DataTables::of($this->job_shortlister_requests->getReturnedForModification())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_shortlister.show', $query->uuid).'">View</a>';
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
        return DataTables::of($this->job_shortlister_requests->getApproved())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_shortlister.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function SavedDatatable()
    {
        return DataTables::of($this->job_shortlister_requests->getSaved())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_shortlister.initiate', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}