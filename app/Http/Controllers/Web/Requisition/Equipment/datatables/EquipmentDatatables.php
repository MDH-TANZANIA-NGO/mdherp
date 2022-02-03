<?php

namespace App\Http\Controllers\Api\Facility\Web\Requisition\Equipment\datatables;

use Yajra\DataTables\DataTables;

trait EquipmentDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->equipments->getForDatatables())
            ->addIndexColumn()
            ->addColumn('price_range', function ($query) {
                return number_2_format($query->price_range_from). ' - ' .number_2_format($query->price_range_to);
            })
//            ->addColumn('action', function($query) {
//                return '<a href="'.route('equipment.show', $query->uuid).'">View</a>';
//            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
