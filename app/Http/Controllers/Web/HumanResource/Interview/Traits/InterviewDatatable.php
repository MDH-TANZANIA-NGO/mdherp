<?php

namespace App\Http\Controllers\Web\HumanResource\Interview\Traits;

use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

trait InterviewDatatable
{
    public function AccessShortlistedDatatable(){
        return DataTables::of($this->hrHireApplicantRepository->getPendingSelected())
            ->addIndexColumn()
            ->addColumn('select',function($query){
                return "<input type='checkbox' name='applicant[]' value='$query->id'>";
            })
            ->rawColumns(['action','select'])
            ->make(true);
    }

    public function AccessProcessingDatatable(){
        return DataTables::of($this->interviewRepository->getAccessProcessingDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessDeniedDatatable(){
        return DataTables::of($this->interviewRepository->getAccessDeniedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.show', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>'. ' '. '<a href="'.route('hireRequisition.edit', $query->uuid).'" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessProvedDatatable(){
        return DataTables::of($this->interviewRepository->getAccessProvedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessRejectedDatatable(){
        return DataTables::of($this->interviewRepository->getAccessRejectedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function AccessSavedDatatable(){
        return DataTables::of($this->interviewRepository->getAccessSavedDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.initiate', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessWaitForQuestionsDatatable(){
        return DataTables::of($this->interviewRepository->getAccessWaitForQuestionsDatatable())
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateString();
            })
            ->editColumn('total', function ($query) {
                return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
                
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('interview.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AccessWaitForReportDatatable(){
        return DataTables::of($this->interviewRepository->getAccessWaitForReportDatatable())
        ->addIndexColumn()
        ->editColumn('created_at', function ($query) {
             return $query->created_at->toDateString();
        })
        ->editColumn('total', function ($query) {
            return $this->hireRequisitionJobRepository->query()->where('hr_hire_requisitions_jobs.hire_requisition_id',$query->id)->sum('empoyees_required');
            
        })
        ->addColumn('action', function($query) {
            return '<a href="'.route('interview.show', $query->uuid).'">View</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function AccessPanelistJobsDatatable(){
        return DataTables::of($this->interviewRepository->getQueryWithInterview())
        ->addIndexColumn()
        ->editColumn('created_at', function ($query) {
            return $query->created_at->toDateString();
        })
        ->addColumn('action', function($query) {
            $action = '<a href="'.route('interview.applicantlist', $query->uuid).'"> View Applicants </a>'; 
            if(isset($query->user_id) && $query->user_id == access()->id()){
                $action .= '| <a href="'.route('interview.question.create', $query->uuid).'"> Add Questions  </a>';
            }
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function AccessResultDatatable(){
        return DataTables::of($this->interviewRepository->getQueryWithInterview())
        ->addIndexColumn()
        ->editColumn('created_at', function ($query) {
            return $query->created_at->toDateString();
        })
        ->addColumn('action', function($query) {
            $action = '<a href="'.route('interview.result.show', $query->uuid).'"> View </a>'; 
             
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
}
