<?php

namespace App\Http\Controllers\Web\HumanResource\Advertisement\Traits;

use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

trait AdvertisementDatatable
{
    public function AccessProcessingDatatable(){
        return DataTables::of($this->advertisementRepository->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('advertisement.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','description'])
            ->make(true);
    }

    public function AccessDeniedDatatable(){
        return DataTables::of($this->advertisementRepository->getAccessDeniedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('advertisement.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. ' '. '<a href="'.route('advertisement.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action','description'])
            ->make(true);
    }

    public function AccessProvedDatatable(){
        return DataTables::of($this->advertisementRepository->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                $action =  '<a href="'.route('advertisement.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','description'])
            ->make(true);
    }

    public function AccessRejectedDatatable(){
        return DataTables::of($this->advertisementRepository->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('advertisement.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','description'])
            ->make(true);
    }

    public function AccessSavedDatatable(){
        return DataTables::of($this->advertisementRepository->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('advertisement.initiate', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','description'])
            ->make(true);
    }
}
