<?php

namespace App\Http\Controllers\Web\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Finance\Datatable\PaymentsDatatable;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use Illuminate\Http\Request;

class FinanceActivityController extends Controller
{
    use PaymentsDatatable;


    protected $safariAdvance;
    protected $requisitions;
    protected $program_activity;
    protected $retirement;

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->retirement = (new RetirementRepository());
    }
    public function index()
    {

        return view('finance.index')
            ->with('requisition', $this->requisitions->getAllApprovedRequisitions())
            ->with('program_activity', $this->program_activity->getAllApprovedProgramActivities())
            ->with('safariAdvance', $this->safariAdvance->getAllApprovedSafari())
            ->with('retirement', $this->retirement->getAllApprovedRetirements());
    }
    public function show($uuid)
    {
       $safari  =  SafariAdvance::all()->where('uuid', $uuid);
       $program_activity =  ProgramActivity::all()->where('uuid', $uuid);

        return view('finance.payments.show')
            ->with('safari_advance', $safari)
            ->with('program_activity', $program_activity);
    }
}
