<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Http\Controllers\Controller;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramActivityController extends Controller
{
    protected $trainings;
    protected $program_activity;
    protected $districts;
    protected $requisition;
    protected $trainingCost;

    public function __construct()
    {
        $this->trainings = (new RequisitionTrainingRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->districts = (new DistrictRepository());
        $this->requisition = (new RequisitionRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
    }

    public function index()
    {
        return view('programactivity.index');
    }

    public  function  create(ProgramActivity $programActivity)
    {

         dd($programActivity->costs);
//

        return view('programactivity.forms.create')

            ->with('training_costs', )
            ->with('district', $this->districts->getForPluck())
            ->with('program_activity', $programActivity);
    }
    public  function  initiate()
    {

        return view('programactivity.forms.initiate')
            ->with('trainings', $this->trainings->getPluckRequisitionNo());
    }
    public function store(Request $request)
    {
        //ddd($this->program_activity->store($request->all()));
        //ddd($request->all());
        $programActivity = $this->program_activity->store($request->all());
        return redirect()->route('programactivity.create', $programActivity);
    }
}
