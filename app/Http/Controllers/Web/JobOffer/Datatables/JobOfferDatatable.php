<?php

use Yajra\DataTables\DataTables;

trait JobOfferDatatable
{
    public function allDatatable()
    {
        return DataTables::of($this->g_officers->getActive())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('g_officer.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
