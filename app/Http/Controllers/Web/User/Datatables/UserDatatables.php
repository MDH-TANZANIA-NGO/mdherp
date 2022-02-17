<?php

namespace App\Http\Controllers\Web\User\Datatables;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait UserDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */
    public function activeDatatable()
    {
        return DataTables::of($this->users->getActive())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('user.profile', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function InactiveDatatable()
    {
        return DataTables::of($this->users->getInactive())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return [
                    'display' => Carbon::parse($query->created_at)->format('Y-m-d H:i:s'),
                    'timestamp' => $query->created_at,
                ];
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('user.profile', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
