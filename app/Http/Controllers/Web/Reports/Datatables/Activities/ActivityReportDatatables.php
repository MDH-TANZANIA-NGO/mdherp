<?php
namespace App\Http\Controllers\Web\Reports\Datatables\Activities;
use Yajra\DataTables\DataTables;

trait ActivityReportDatatables
{
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->activity_reports->getAccessProcessing())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success">view</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->activity_reports->getAccessProcessing())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success">view</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->activity_reports->getAccessProcessing())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success">view</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
