<?php

namespace App\Http\Controllers\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait GOfficerDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->g_officers->getFilteredGofficerByRegion(access()->user()->region_id))
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_officer.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
