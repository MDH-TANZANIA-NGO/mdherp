<?php
namespace App\Http\Controllers\Web\JobOffer\Datatables;

use Yajra\DataTables\DataTables;

trait JobOfferDatatable
{
    public function onProcess()
    {
        return DataTables::of($this->job_offers->getAccessProcessing())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_officer.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
