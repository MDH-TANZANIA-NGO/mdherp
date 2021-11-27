<?php

namespace App\Http\Controllers\Web\Requisition\Training\Traits;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Training\requisition_training_cost;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

trait trainingCostsDatatable
{
    //
    public function alldatatable(Request  $request)
    {
        if ($request->ajax()) {
            $data = requisition_training_cost::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="#">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('training.index');
    }
}
