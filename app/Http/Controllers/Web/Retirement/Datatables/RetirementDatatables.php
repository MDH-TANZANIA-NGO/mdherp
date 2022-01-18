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
    /* public function AccessApprovedDatatable()
     {
         return DataTables::of($this->safariAdvance->getAccessProvedDatatable())
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
                 return '<a href="'.route('safari.show', $query->uuid).'">View</a>';
             })
             ->rawColumns(['action'])
             ->make(true);
     }
     public function AccessDatatable()
     {
         return DataTables::of($this->safariAdvance->getAccessSavedDatatable())
             ->addIndexColumn()
             ->editColumn('created_at', function ($query) {
                 return $query->created_at->toDateTimeString();
             })
             ->addColumn('amount', function ($query) {
                 return number_2_format($query->amount_requested);
             })
             ->addColumn('action', function($query) {
                 return '<a href="'.route('safari.edit', $query->uuid).'">View</a>';
             })
             ->rawColumns(['action'])
             ->make(true);
     }
     public function AccesssDatatable()
     {
         return DataTables::of($this->safariAdvance->getAccessPaidDatatable())
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
                 return '<a href="'.route('safari.show', $query->uuid).'">View</a>';
             })
             ->rawColumns(['action'])
             ->make(true);
     }*/
}
