<?php

namespace App\Http\Controllers\Api\Facility\Web\ProgramActivity\Datatable;

use Yajra\DataTables\DataTables;

trait ProgramActivityDatatable
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->program_activity->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->program_activity->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->program_activity->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('amount_paid', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessDatatable()
    {
        return DataTables::of($this->program_activity->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.create', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccesssDatatable()
    {
        return DataTables::of($this->program_activity->getAccessPaidDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('amount_paid', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

//    reports Datatables

    public function ReportNewDatatable()
    {
        return DataTables::of($this->program_activity->getReportNewDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('region_id', function ($query) {
                return $query->region->name;
            })
            ->addColumn('user_id', function ($query) {
                return $query->user->full_name;
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function ReportRejectedDatatable()
    {
        return DataTables::of($this->program_activity->getReportRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('region_id', function ($query) {
                return $query->region->name;
            })
            ->addColumn('user_id', function ($query) {
                return $query->user->full_name;
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function ReportApprovedDatatable()
    {
        return DataTables::of($this->program_activity->getReportApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('region_id', function ($query) {
                return $query->region->name;
            })
            ->addColumn('user_id', function ($query) {
                return $query->user->full_name;
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivity.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
