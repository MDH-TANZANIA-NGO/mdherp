<?php

namespace App\Http\Controllers\Api\Facility\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait GRateDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->g_rates->getActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_rate.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
