<?php

namespace App\Http\Controllers\Web\GOfficer\Datatables;

use Yajra\DataTables\DataTables;

trait TemporaryImportedBeneficiaryDatatable
{
    public function bulkImported()
    {
        return DataTables::of($this->g_officer_imported_data_repo->getAccessandJoinOtherTables())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="#" ><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
