<?php

namespace App\Http\Controllers\Web\Project\Traits;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait OutputUnitDatatables
{
    public function allDatatable()
    {
        return DataTables::of($this->output_units->getActive())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('output_unit.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);
    }
}
