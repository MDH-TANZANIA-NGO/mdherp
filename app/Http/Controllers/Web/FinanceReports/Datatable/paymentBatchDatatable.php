<?php

namespace App\Http\Controllers\Web\FinanceReports\Datatable;

use Yajra\DataTables\DataTables;

trait paymentBatchDatatable
{
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->financial_reports->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('requested_amount', function ($query) {
                return number_2_format($query->requested_amount);
            })
            ->addColumn('payed_amount', function ($query) {
                return number_2_format($query->payed_amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.view', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
//    public function AccessRejectedDatatable()
//    {
//        return DataTables::of($this->safariAdvance->getAccessRejectedDatatable())
//            ->addIndexColumn()
//            ->editColumn('created_at', function ($query) {
//                return $query->created_at->toDateTimeString();
//            })
//            ->addColumn('amount', function ($query) {
//                return number_2_format($query->amount_requested);
//            })
//            ->addColumn('action', function($query) {
//                return '<a href="'.route('safari.show', $query->uuid).'">View</a>';
//            })
//            ->rawColumns(['action'])
//            ->make(true);
//    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->financial_reports->getAccessApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('requested_amount', function ($query) {
                return number_2_format($query->requested_amount);
            })
            ->addColumn('payed_amount', function ($query) {
                return number_2_format($query->payed_amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('finance.view', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
