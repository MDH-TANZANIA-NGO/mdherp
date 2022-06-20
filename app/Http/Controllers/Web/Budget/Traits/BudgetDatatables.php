<?php

namespace App\Http\Controllers\Web\Budget\Traits;

use Yajra\DataTables\DataTables;

trait BudgetDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allActiveDatatable()
    {
        return DataTables::of($this->budgets->getAllActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('activity.show_fiscal_year', [$query->activity_uuid,$query->fiscal_year_uuid]).'">View</a>';
            })
            ->editColumn('region_list', function ($query){
                return $query->region_list ? $query->region_list : "<span class='badge badge-warning'>Above site</span>";
            })
            ->rawColumns(['region_list','action'])
            ->make(true);
    }
}
