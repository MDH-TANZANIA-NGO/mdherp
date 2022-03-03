<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityDatatable;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Illuminate\Http\Request;

class ProgramActivityReportController extends Controller
{
    //
    use ProgramActivityDatatable;

    protected $program_activities;

    public function __construct(){

        $this->program_activities =  (new ProgramActivityRepository());
    }

    public function index(){

        return view('programactivity.datatable.reports.all')
            ->with('program_activities', $this->program_activities);
    }

    public function create(){

    }

    public function edit(){

    }
}
