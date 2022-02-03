<?php

namespace App\Http\Controllers\Web\Safari\Datatables;

use Yajra\DataTables\DataTables;

trait SafariDatatables
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->safariAdvance->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->safariAdvance->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. ''. '<a href="'.route('safari.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->safariAdvance->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('amount_paid', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessDatatable()
    {
        return DataTables::of($this->safariAdvance->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.edit', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessPaidDatatable()
    {
        return DataTables::of($this->safariAdvance->getAccessPaidDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount_requested', function ($query) {
                return number_2_format($query->amount_requested);
            })
            ->addColumn('amount_paid', function ($query) {
                return number_2_format($query->amount_paid);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('safari.show', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
