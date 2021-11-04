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
            ->make(true);
    }
}
