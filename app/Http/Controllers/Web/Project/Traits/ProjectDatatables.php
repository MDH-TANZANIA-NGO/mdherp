<?php

namespace App\Http\Controllers\Web\Project\Traits;

use App\Models\System\Region;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait ProjectDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        $tafs = $this->projects->getActive();
        return DataTables::of($tafs)
            ->addIndexColumn()
            ->editColumn('description', function ($query) {
                return substr($query->description, 0, 100)."...";
            })
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('project.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
