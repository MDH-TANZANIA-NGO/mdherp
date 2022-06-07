<?php

namespace App\Http\Controllers\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait NewGovernmentScaleDatatables
{

    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allGovernmentScales()
    {
        return DataTables::of($this->government_scale->getActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_scale.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

}
