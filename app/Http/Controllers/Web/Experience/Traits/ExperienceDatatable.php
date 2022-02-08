<?php

namespace App\Http\Controllers\Web\Experience\Traits;

use App\Models\Experience\Experience;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

trait ExperienceDatatable
{
    public function allDatatable(){
        $data = Experience::where('user_id', access()->id())->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('summary', function ($query) {
                return substr($query->summary, 0, 50)."...";
            })
            ->editColumn('supervisor', function ($query) {
                return substr($query->supervisor, 0, 50)."...";
            })
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('experience.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);;
    }
}
