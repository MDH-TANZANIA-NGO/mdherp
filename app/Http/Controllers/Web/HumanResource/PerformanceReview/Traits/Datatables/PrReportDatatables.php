<?php

namespace App\Http\Controllers\Web\HumanResource\PerformanceReview\Traits\Datatables;

use App\Models\HumanResource\PerformanceReview\PrReport;
use Yajra\DataTables\DataTables;

trait PrReportDatatables
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessProcessingDatatable()
    {
        return DataTables::of($this->pr_reports->getAccessProcessing())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.pr.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessReturnedForModificationDatatable()
    {
        return DataTables::of($this->pr_reports->getAccessReturnedForModification())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.pr.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessApprovedDatatable()
    {
        return DataTables::of($this->pr_reports->getAccessApproved())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.pr.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessSavedDatatable()
    {
        return DataTables::of($this->pr_reports->getAccessSaved())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.pr.saved', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessApprovedWaitForEvaluationDatatable()
    {
        return DataTables::of($this->pr_reports->getAccessApprovedWaitForEvaluation())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hr.pr.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}