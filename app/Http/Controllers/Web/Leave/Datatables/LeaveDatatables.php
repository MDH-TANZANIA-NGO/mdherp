<?php

namespace App\Http\Controllers\Web\Leave\Datatables;

use App\Models\Leave\Leave;
use Yajra\DataTables\DataTables;

trait LeaveDatatables
{

    public function AccessProcessingDatatable()
    {
        //dd($this->leaves->getAccessProcessingDatatable()->get());
        return DataTables::of($this->leaves->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
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
    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->leaves->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
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
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->leaves->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
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
    public function AccessSavedDatatable()
    {
        return DataTables::of($this->leaves->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('start_date', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('leave.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
