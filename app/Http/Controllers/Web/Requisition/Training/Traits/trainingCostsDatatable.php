<?php

namespace App\Http\Controllers\Web\Requisition\Training\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

trait trainingCostsDatatable
{
    //
    public function alldatatable()
    {
        return DataTables::of($this->training_costs->training())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
//                return '<a href="'.route('stock_unit.show', $query->uuid).'">View</a>';
                return '<a href="#">View</a>';
            })
//            ->rawColumns(['action'])
            ->make(true);
    }
}
