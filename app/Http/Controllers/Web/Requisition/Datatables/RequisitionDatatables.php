<?php

namespace App\Http\Controllers\Web\Requisition\Datatables;

use Yajra\DataTables\DataTables;

trait RequisitionDatatables
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->requisitions->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('requisition.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i> </a>';
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
        return DataTables::of($this->requisitions->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('requisition.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. '<a href="'.route('requisition.addDescription', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
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
        return DataTables::of($this->requisitions->getAccessApprovedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('requisition.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AccessSavedDatatable()
    {
        return DataTables::of($this->requisitions->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('amount', function ($query) {
                return number_2_format($query->amount);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('requisition.addDescription', $query->uuid).'"class="btn btn-outline-success"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessPaidDatatable()
    {
        return DataTables::of($this->requisitions->getAccessPaidDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->addColumn('payed_amount', function ($query) {
                return number_2_format($query->payed_amount);
            })
            ->editColumn('is_closed', function ($query) {
                if ($query->is_closed == false)
                return 'Not Closed';
                else{
                    return 'Closed';
                }
            })
            ->addColumn('action', function($query) {
                if ($query->is_closed ==  true)
                {
                    return '<a href="'.route('requisition.show', $query->uuid).'"class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
                }else{
                    return '<a href="'.route('requisition.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'.''.'<a href="'.route('requisition.updateActualAmount', $query->uuid).'" class="btn btn-outline-danger" ><i class="fa fa-close"></i></a>';

                }
                 })
            ->rawColumns(['action'])
            ->make(true);
    }
}
