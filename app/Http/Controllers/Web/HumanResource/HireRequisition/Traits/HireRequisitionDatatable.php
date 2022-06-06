<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

trait HireRequisitionDatatable
{
    public function AccessProcessingDatatable(){
        return DataTables::of($this->hireRequisition->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            // ->editColumn('budget', function ($query) {
            //     if ($query->budget == true){
            //         return "Available";
            //     }
            //     return "No Budget";
            // })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hirerequisition.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessDeniedDatatable(){
        return DataTables::of($this->hireRequisition->getAccessDeniedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hirerequisition.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. ' '. '<a href="'.route('hireRequisition.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessProvedDatatable(){
        return DataTables::of($this->hireRequisition->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hirerequisition.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessRejectedDatatable(){
        return DataTables::of($this->hireRequisition->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('hirerequisition.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
