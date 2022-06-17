<?php

namespace App\Http\Controllers\Web\Education\Traits;

use App\Models\Education\Education;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait EducationDatatable
{
    public function allDatatable(){
        $data = Education::where('user_id', access()->id())->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('education.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);
    }
}
