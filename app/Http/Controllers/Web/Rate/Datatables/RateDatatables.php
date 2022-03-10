<?php

namespace App\Http\Controllers\Web\Rate\Datatables;

use Yajra\DataTables\DataTables;

trait RateDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->rates->getAll())
            ->addIndexColumn()
            ->addColumn('status', function ($query) {
                return $query->active ? "<span class='badge badge-success'/>ACTIVE</span>" : "<span class='badge badge-danger'/>IN-ACTIVE</span>";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('rate.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}
