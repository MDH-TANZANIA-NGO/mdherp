<?php

namespace App\Http\Controllers\Api\Facility\Web\Project\Traits;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait SubProgramDatatables
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->sub_programs->getActive())
            ->addIndexColumn()
            ->editColumn('description', function ($query) {
                return substr($query->description, 0, 50)."...";
            })
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('sub_program.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);
    }
}
