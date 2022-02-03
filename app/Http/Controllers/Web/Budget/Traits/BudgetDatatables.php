<?php

namespace App\Http\Controllers\Api\Facility\Web\Budget\Traits;

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
            ->make(true);
    }
}
