<?php

namespace App\Http\Controllers\Web\Reports\Traits;


use Yajra\DataTables\DataTables;

trait LeaveReportDatatable
{
    public function getSubmittedLeaves()
    {
        return DataTables::of($this->leaves->getSubmittedLeaves())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('leave.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getRejectedLeaves()
    {
        return DataTables::of($this->leaves->getRejectedLeaves())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('leave.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getApprovedLeaves()
    {
        return DataTables::of($this->leaves->getApprovedLeaves())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('leave.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
