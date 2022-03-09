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
        return DataTables::of($this->rates->getAllActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('rate.show', $query->uuid).'">View</a>';
            })
            ->make(true);
    }
}
