<?php

namespace App\Http\Controllers\Web\Fleet\Traits;
use Yajra\DataTables\DataTables;


trait FleetDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */

    public function allFleetDatatable()
    {
        return DataTables::of($this->fleets->getAllFleets())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="#" class="alert alert-success">View</a>';
            })
            ->make(true);
    }
}
