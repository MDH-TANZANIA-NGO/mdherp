<?php

namespace App\Http\Controllers\Api\Facility\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait GScaleDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->g_scales->getActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_scale.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }
}
