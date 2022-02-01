<?php

namespace App\Http\Controllers\Web\Retirement\Datatables;

use Yajra\DataTables\DataTables;

trait RetirementDatatables
{

    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->retirements->getAccessProcessingRetirementDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('retirement.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->retirements->getAccessRejectedRetirementDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('retirement.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
     public function AccessApprovedDatatable()
     {
         return DataTables::of($this->retirements->getAccessApprovedRetirementDatatable())
             ->addIndexColumn()
             ->editColumn('created_at', function ($query) {
                 return $query->created_at->toDateTimeString();
             })
             ->addColumn('amount', function ($query) {
                 return number_2_format($query->amount_paid);
             })
             ->addColumn('action', function($query) {
                 return '<a href="'.route('retirement.show', $query->uuid).'">View</a>';
             })
             ->rawColumns(['action'])
             ->make(true);
     }
    public function AccessSavedDatatable()
    {
        return DataTables::of($this->retirements->getAccessSavedRetirementDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('retirement.edit', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
