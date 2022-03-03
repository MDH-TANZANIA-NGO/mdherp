<?php

namespace App\Http\Controllers\Web\Reports;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Reports\Traits\LeaveReportDatatable;
use App\Repositories\Leave\LeaveRepository;
use Illuminate\Http\Request;

class LeaveReportController extends Controller
{
   use LeaveReportDatatable;

    protected $leaves;

    public function __construct(){
        $this->leaves = (new LeaveRepository());
    }

    public function index(){
        return view('reports.hr.leave.index')
            ->with('leaves', $this->leaves);
    }
}
