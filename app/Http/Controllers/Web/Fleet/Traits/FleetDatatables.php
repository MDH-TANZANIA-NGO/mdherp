<?php

namespace App\Http\Controllers\Web\Fleet\Traits;
use Yajra\DataTables\DataTables;


trait FleetDatatables
{
    /**
     * get access user rejected
     * @return mixed
     * @throws \Exception
     */

//     public function allFleetDatatable()
//     {
//         return DataTables::of($this->fleet_requests->getAllFleets())
//             ->addIndexColumn()
//             ->addColumn('action', function($query) {
// //                return '<a href="#" class="alert alert-success">View</a>';
//                 return '<a href="#">View</a>';
//             })
//             ->make(true);
//     }


    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->fleet_requests->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at;
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  'Not Approved';
                return $query->wf_done_dateformat('d/m/Y');
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('fleet.show', $query->uuid) . '">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public  function AccessRejectedDatatable()
    {
        return Datatables::of($this->fleet_requests->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at;
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  "Not Approved";
                return $query->wf_done_date->format('d/m/Y');
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('fleet.show', $query->uuid) . '" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>' . '&nbsp' . '<a href="' . route('fleet.edit', $query->uuid) . '" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->fleet_requests->getAccessApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->editColumn('wf_done_date', function ($query) {
                return date('Y-m-d', strtotime($query->wf_done_date));
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('fleet.show', $query->uuid) . '">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessSavedDatatable()
    {
        return DataTables::of($this->fleet_requests->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at;
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('fleet.edit', $query->uuid) . '">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
