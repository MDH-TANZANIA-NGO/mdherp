<?php

namespace App\Http\Controllers\Web\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Timesheet\TimesheetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Reports\Traits\TimesheetReportDatatable;

class TimesheetReportController extends Controller
{
    use TimesheetReportDatatable;

    protected $timesheets;
    protected $users;

    public function __construct(){
        $this->timesheets = (new TimesheetRepository());
        $this->users =  (new  UserRepository());
    }


    public function index(){
        return view('reports.hr.timesheet.index')
            ->with('users', $this->users)
            ->with('timesheets', $this->timesheets);
    }
}
