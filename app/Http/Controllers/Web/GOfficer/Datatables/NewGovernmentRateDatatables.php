<?php

namespace App\Http\Controllers\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait NewGovernmentRateDatatables
{

    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */

    public function allGovRatesDatatable()
    {
        return DataTables::of($this->gov_rates->getActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_rate.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
