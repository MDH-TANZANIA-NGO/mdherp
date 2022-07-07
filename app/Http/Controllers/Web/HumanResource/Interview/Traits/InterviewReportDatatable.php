<?php

namespace App\Http\Controllers\Web\HumanResource\Interview\Traits;
use Yajra\DataTables\DataTables;

trait InterviewReportDatatable
{
    public function AccessProcessingDatatable(){
        return DataTables::of($this->interviewReportRepository->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.report.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessDeniedDatatable(){
        return DataTables::of($this->interviewReportRepository->getAccessDeniedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.report.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. ' '. '<a href="'.route('hireRequisition.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessProvedDatatable(){
        return DataTables::of($this->interviewReportRepository->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.report.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessRejectedDatatable(){
        return DataTables::of($this->interviewReportRepository->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.report.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessSavedDatatable(){
        return DataTables::of($this->interviewReportRepository->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.report.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
