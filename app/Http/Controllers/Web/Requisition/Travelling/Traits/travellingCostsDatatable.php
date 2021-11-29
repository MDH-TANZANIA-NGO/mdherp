<?php

namespace App\Http\Controllers\Web\Requisition\Travelling\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

trait travellingCostsDatatable
{
    public function alldatatable()
    {
        return DataTables::of($this->travellingCost->getQuery())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
//                return '<a href="'.route('stock_unit.show', $query->uuid).'">View</a>';
                return '<a href="#">View</a>';
            })
//            ->rawColumns(['action'])
            ->make(true);
    }
}
