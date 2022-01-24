<?php

namespace App\Http\Controllers\Web\Finance\Datatable;

use Yajra\DataTables\DataTables;

trait PaymentsDatatable
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function allApprovedSafariAdvances()
    {
        return DataTables::of($this->safariAdvance->getAllApprovedSafari())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allApprovedRequisitions()
    {
        return DataTables::of($this->requisitions->getAllApprovedRequisitions())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allApprovedProgramActivities()
    {
        return DataTables::of($this->program_activity->getAllApprovedProgramActivities())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
//            ->addColumn('amount_paid', function ($query) {
//                return number_2_format($query->amount_paid);
//            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allApprovedRetirements()
    {
        return DataTables::of($this->retirement->getAllApprovedRetirements())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
//    public function AccesssDatatable()
//    {
//        return DataTables::of($this->safariAdvance->getAccessPaidDatatable())
//            ->addIndexColumn()
//            ->editColumn('created_at', function ($query) {
//                return $query->created_at->toDateTimeString();
//            })
//            ->addColumn('amount_requested', function ($query) {
//                return number_2_format($query->amount_requested);
//            })
//            ->addColumn('amount_paid', function ($query) {
//                return number_2_format($query->amount_paid);
//            })
//            ->addColumn('action', function($query) {
//                return '<a href="'.route('safari.show', $query->uuid).'">View</a>';
//            })
//            ->rawColumns(['action'])
//            ->make(true);
//    }
}
