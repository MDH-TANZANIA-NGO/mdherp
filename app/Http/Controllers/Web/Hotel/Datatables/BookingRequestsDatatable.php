<?php

namespace App\Http\Controllers\Web\Hotel\Datatables;

use Yajra\DataTables\DataTables;

trait bookingRequestsDatatable
{
    public function getAllSafariBookingRequests()
    {
        return DataTables::of($this->hotels->getAllApprovedSafariBookingHotels()->get())
            ->addIndexColumn()

            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->safari_uuid).'" class="btn btn-outline-success">view</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
