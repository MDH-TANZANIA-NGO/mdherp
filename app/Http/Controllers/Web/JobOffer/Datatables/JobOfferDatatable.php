<?php
namespace App\Http\Controllers\Web\JobOffer\Datatables;

use Yajra\DataTables\DataTables;

trait JobOfferDatatable
{
    public function AccessProcessingDatatable()
    {
        return DataTables::of($this->job_offers->getAccessProcessing())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_offer.show', $query->uuid).'">view</a>';
            })
            ->addColumn('full_name', function($query) {
                return $query->interviewApplicant->applicant->full_name;
            })
            ->addColumn('full_title', function($query) {
                return $query->interviewApplicant->interviews->jobRequisition->designation->full_title;
            })
            ->editColumn('salary', function($query) {

                $salary = currency_converter($query->salary, 'TSH');
                return $salary;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessRejectedDatatable()
    {
        return DataTables::of($this->job_offers->getAccessRejected())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_offer.show', $query->uuid).'">view</a>';
            })
            ->addColumn('full_name', function($query) {
                return $query->interviewApplicant->applicant->full_name;
            })
            ->addColumn('full_title', function($query) {
                return $query->interviewApplicant->interviews->jobRequisition->designation->full_title;
            })
            ->editColumn('salary', function($query) {

                $salary = currency_converter($query->salary, 'TSH');
                return $salary;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessApprovedDatatable()
    {
        return DataTables::of($this->job_offers->getAccessApproved())
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return '<a href="'.route('job_offer.show', $query->uuid).'">view</a>';
            })
            ->addColumn('full_name', function($query) {
                return $query->interviewApplicant->applicant->full_name;
            })
            ->addColumn('full_title', function($query) {
                return $query->interviewApplicant->interviews->jobRequisition->designation->full_title;
            })
            ->addColumn('status', function($query) {
                if ($query->status == 1)
                {
                    return 'Accepted';
                }
                if ($query->status == 2){
                     return 'Rejected';
                }
                if ($query->status ==  null)
                {
                    return  'Pending..';
                }

            })
            ->editColumn('salary', function($query) {

                $salary = currency_converter($query->salary, 'TSH');
                return $salary;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
