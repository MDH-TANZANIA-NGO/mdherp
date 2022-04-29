<?php

namespace App\Http\Controllers\Web\Reports;

use App\Http\Controllers\Controller;
use App\Models\Timesheet\Timesheet;
use App\Repositories\Access\UserRepository;
use App\Repositories\Timesheet\TimesheetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Reports\Traits\TimesheetReportDatatable;
use Illuminate\Support\Facades\DB;

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

        $months = Timesheet::select(
            DB::raw("(to_char(created_at, 'mm-yyyy')) as month_year")
        )
            ->distinct()
            ->orderBy('month_year')
            ->get();
        //dd($months);

        return view('reports.hr.timesheet.index')
            ->with('users', $this->users)
            ->with('timesheets', $this->timesheets)
            ->with('months', $months);
    }
}
