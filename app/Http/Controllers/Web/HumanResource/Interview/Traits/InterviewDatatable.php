<?php

namespace App\Http\Controllers\Web\HumanResource\Interview\Traits;

use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

trait InterviewDatatable
{
    public function AccessShortlistedDatatable(){
        return DataTables::of($this->hrHireApplicantRepository->getPendingSelected())
            ->addIndexColumn()
            // ->editColumn('created_at', function ($query) {
            //     // return $query->created_at->toDateString();
            // })
            ->addColumn('select',function($query){
                return "<input type='checkbox' name='applicant[]' value='$query->id'>";
            })
            ->rawColumns(['action','select'])
            ->make(true);
    }
}
