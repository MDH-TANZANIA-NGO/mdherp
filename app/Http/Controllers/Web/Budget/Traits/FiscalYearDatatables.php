<?php

namespace App\Http\Controllers\Web\Budget\Traits;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait FiscalYearDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->fiscal_years->getActive())
            ->addIndexColumn()
            ->editColumn('total_amount', function ($query) {
                return number_2_format($query->total_amount). '/=';
            })
            ->addColumn('status', function ($query) {
                return $query->active?"<span class='badge badge-success'/>ACTIVE</span>" : "<span class='badge badge-danger'/>DE-ACTIVE</span>";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('fiscal_year.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }
}
