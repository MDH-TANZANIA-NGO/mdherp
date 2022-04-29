<?php
namespace App\Http\Controllers\Web\Reports\Traits;

use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;


trait TimesheetReportDatatable
{
    public function getMonthAndYear()
    {
        $date = \Carbon\Carbon::now();
        $lastmonth =  $date->subMonth()->format('m');
        $year = $date->format('Y');
        return [$lastmonth, $year];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getSubmittedTimesheets(){
        $data = request();
        $timestamp = explode("-", $data['month']);
        $default = $this->getMonthAndYear();

            if (isset($timestamp)){
                return DataTables::of($this->timesheets->getSubmittedTimesheets($timestamp[0], $timestamp[1]))
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



        return DataTables::of($this->timesheets->getSubmittedTimesheets($default[0], $default[1]))
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
        $data = request();
        $timestamp = explode("-", $data['month']);
        $fallback = $timestamp ?? $this->getMonthAndYear();
        return DataTables::of($this->timesheets->getApprovedTimesheets())
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
        $data = request();
        $timestamp = explode("-", $data['month']);
        $fallback = $timestamp ?? $this->getMonthAndYear();
        return DataTables::of($this->timesheets->getRejectedTimesheets())
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

    public function getAllNotSubmittedTimesheet(){
        $month = date('m', strtotime(today()));
        $year =  date('Y', strtotime(today()));
        return DataTables::of($this->users->getAllNotSubmittedTimesheet($month, $year))
            ->addIndexColumn()

            ->rawColumns(['action'])
            ->make(true);
    }

}
