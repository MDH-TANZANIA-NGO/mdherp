<?php

namespace App\Http\Controllers\Web\ProgramActivity\Datatable;

use Yajra\DataTables\DataTables;

trait ProgramActivityReportDatatable
{
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->program_activity_report->getOnprogressActivityReports())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivityreport.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessReturnedDatatable()
    {
        return DataTables::of($this->program_activity_report->getReturnedActivityReports())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivityreport.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->program_activity_report->getApprovedActivityReports())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivityreport.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessSavedDatatable()
    {
        return DataTables::of($this->program_activity_report->getSavedActivityReports())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('programactivityreport.edit', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
