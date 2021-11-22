<?php

namespace App\Http\Controllers\Web\Requisition\Datatables;

use Yajra\DataTables\DataTables;

trait RequisitionDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function processingDatatable()
    {
        return DataTables::of($this->requisitions->processingDatatable())
            ->addIndexColumn()
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('requisition.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
