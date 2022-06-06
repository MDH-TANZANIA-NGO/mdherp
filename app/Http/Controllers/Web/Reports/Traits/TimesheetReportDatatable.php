<?php
namespace App\Http\Controllers\Web\Reports\Traits;

use http\Client\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

trait TimesheetReportDatatable
{

    public function getSubmittedTimesheets(){
        $data = request()->input('month');
        if (isset($data)){
            $timestamp = explode("-", $data);
            $month = $timestamp[0];
            $year = $timestamp[1];
        }
        return DataTables::of($this->timesheets->getSubmittedTimesheets($month, $year))
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  "Not Approved";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getApprovedTimesheets(){
        $data = request()->input('month');
        if (isset($data)){
            $timestamp = explode("-", $data);
            $month = $timestamp[0];
            $year = $timestamp[1];
        }
        return DataTables::of($this->timesheets->getApprovedTimesheets($month, $year))
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                $date = strtotime($query->wf_done_date);
                return date('d/m/Y', $date);
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getRejectedTimesheets(){
        $data = request()->input('month');
        if (isset($data)){
            $timestamp = explode("-", $data);
            $month = $timestamp[0];
            $year = $timestamp[1];
        }
        return DataTables::of($this->timesheets->getRejectedTimesheets($month, $year))
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->editColumn('wf_done_date', function ($query) {
                if ($query->wf_done_date == null)
                    return  'Not Approved';
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('timesheet.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllNotSubmittedTimesheet( ){
        $data = request()->input('month');
        if (isset($data)){
            $timestamp = explode("-", $data);
            $month = $timestamp[0];
            $year = $timestamp[1];
        }
        return DataTables::of($this->users->getAllNotSubmittedTimesheet($month, $year))
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

}
