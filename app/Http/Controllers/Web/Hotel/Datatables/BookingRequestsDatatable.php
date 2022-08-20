<?php

namespace App\Http\Controllers\Web\Hotel\Datatables;

use Yajra\DataTables\DataTables;

trait bookingRequestsDatatable
{
    public function getAllSafariBookingRequests()
    {
        return DataTables::of($this->getAllSafariBookingRequests())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
