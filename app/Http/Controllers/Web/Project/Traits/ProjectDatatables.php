<?php

namespace App\Http\Controllers\Web\Project\Traits;

use App\Models\System\Region;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait ProjectDatatables
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function allDatatable()
    {
        return DataTables::of($this->projects->getActive())
            ->addIndexColumn()
            ->editColumn('description', function ($query) {
                return substr($query->description, 0, 50)."...";
            })
            ->editColumn('type', function ($query) {
                $return = '<span class="badge badge-info">'.$query->type.'</span>';
                if($query->type_id != config('mdh.project.with_region'))
                    $return = '<span class="badge badge-success">'.$query->type.'</span>';
                return $return;
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
            ->rawColumns(['action','type'])
            ->make(true);
    }
}
