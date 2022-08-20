<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Events\NewWorkflow;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Web\Requisition\Datatables\RequisitionDatatables;
use App\Models\Budget\Budget;
use App\Models\GOfficer\GOfficer;
use App\Models\Payment\Payment;
use App\Models\Requisition\RequisitionType\requisition_type_category;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Training\RequisitionTrainingCostFavourite;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
use App\Repositories\Access\UserRepository;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\Finance\FinancialReportsRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingCostFavouriteRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\trainingRepository;
use App\Repositories\System\RegionRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use App\Services\Workflow\Workflow;
use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\RequisitionType\RequisitionTypeRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;
use Symfony\Component\Console\Input\Input;

class RequisitionController extends Controller
{
    use RequisitionDatatables, InitiatorBudgetChecker;
    protected $requisitions;
    protected $requisition_types;
    protected $projects;
    protected $equipments;
    protected $districts;
    protected $wf_tracks;
    protected $gofficer;
    protected $grate;
    protected $mdh_rates;
    protected $users;
    protected $requisition_type_category;
    protected $regions;
    protected $requisition_training;
    protected $requisition_training_items;
    protected $financialReport;
    protected $training_cost_favourites;
    protected $training_cost;


    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->requisition_types = (new RequisitionTypeRepository());
        $this->projects = (new ProjectRepository());
        $this->equipments = (new EquipmentRepository());
        $this->districts = (new DistrictRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->gofficer = (new GOfficerRepository());
        $this->grate = (new GRateRepository());
        $this->mdh_rates = (new mdhRatesRepository());
        $this->users = (new UserRepository());
        $this->requisition_type_category = (new requisition_type_category());
        $this->regions = (new RegionRepository());
        $this->requisition_training = (new trainingRepository());
        $this->requisition_training_items = (new RequisitionTrainingItemsRepository());
        $this->financialReport = (new FinancialReportsRepository());
        $this->training_cost_favourites =  (new RequisitionTrainingCostFavouriteRepository());
        $this->training_cost =  (new RequestTrainingCostRepository());


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('requisition._parent.index');
    }
    public function allRequisitions()
    {
        $all_requisitions =  $this->requisitions->getAllRequisitions();
        return view('requisition._parent.all-requisitions')
            ->with('all_requisitions', $all_requisitions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('requisition._parent.form.create')
            ->with('requisition_types', $this->requisition_types->getAll()->pluck('title','id'))
            ->with('projects', $this->projects->getAccessUserProjectsPluck())
            ->with('requisition_type_category', $this->requisition_type_category->get()->pluck('name', 'id'))
            ->with('regions', $this->regions->forSelect());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $requisition = $this->requisitions->store($request->all());
        $mdh_rates = $this->mdh_rates->getForPluck();
        alert()->success('Requisition Stored Successfully');
        return redirect()->route('requisition.addDescription',[$requisition]);

    }
    public function addDescription(Requisition $requisition)
    {
        return view('requisition.description.forms.create')
            ->with('requisition', $requisition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initiate(Requisition $requisition)
    {
 return view('requisition._parent.form.initiate')
            ->with('requisition', $requisition)
            ->with('items', $requisition->items)
            ->with('travelling_costs',$requisition->travellingCost)
            ->with('training_costs', $requisition->trainingCost)
            ->with('equipments', $this->equipments->getQuery()->get()->pluck('title','id'))
            ->with('districts', $this->districts->getForPluck())
            ->with('gofficer',$this->gofficer->getForPluckUnique())
            ->with('grate',$this->grate->getQuery()->get()->pluck('amount','id'))
            ->with('mdh_rates',$this->mdh_rates->getForPluck())
            ->with('users', $this->users->getQuery()->pluck('name', 'user_id'))
            ->with('requisition_training_items', $requisition->trainingItems)
            ->with('training', $requisition->training)
            ->with('training_details', $requisition->training()->first())
            ->with('access_training_costs_favourites', $this->training_cost_favourites->getAccessFavourites()->get())
            ->with('requisition_favourite', RequisitionTrainingCostFavourite::query()->where('requisition_id', '=', $requisition->id)->first())
            ->with('training_costs_favourites', $this->training_cost_favourites->getAccessFavoritesForPluck());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Requisition $requisition)
    {
        $budget = $this->check($requisition->requisition_type_id, $requisition->project_id, $requisition->activity_id, $requisition->region_id, $requisition->budget()->first()->fiscal_year_id);
        /* Check workflow */
        $wf_module_group_id = 1;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $requisition->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $requisition->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($requisition, $current_level, $workflow->wf_definition_id);
        return view('requisition._parent.display.show')
            ->with('requisition', $requisition)
           ->with('training', $requisition->training()->first())
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($requisition))
            ->with('items', $requisition->items)
            ->with('travelling_costs',$requisition->travellingCost)
            ->with('budget', $budget)
            ->with('training_costs', $requisition->trainingCost)
            ->with('gofficer',$this->gofficer->getQuery()->get()->pluck('first_name', 'id'))
            ->with('grate',$this->grate->getQuery()->get()->pluck('amount','id'))
            ->with('mdh_rates',$this->mdh_rates->getForPluck())
            ->with('users', $this->users->getUserQuery()->pluck('email', 'user_id'))
            ->with('approved_requisitions', $this->requisitions->getAllApprovedNotClosedInSameBudget()->pluck('amount')->sum())
            ->with('not_approved_requisitions', $this->requisitions->getAllNotApprovedInTheSameBudget()->pluck('amount')->sum())
            ->with('denied_requisitions', $this->requisitions->getAllDeniedInTheSameBudget()->pluck('amount')->sum())
            ->with('payed_and_closed', $this->requisitions->getPayedAmount()->pluck('paid_amount')->sum())
            ->with('trainingItems', $requisition->trainingItems);
    }

    /**
     * Update the specified resource in storage.
     *
     * @paam  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Requisition $requisition)
    {
//        check_available_budget_individual($requisition,$requisition->amount);
        DB::transaction(function () use ($requisition){
//            $actual_amount = $requisition->budget->actual_amount;
            $budget_attributes =  $this->check($requisition->requisition_type_id, $requisition->project_id, $requisition->activity_id, $requisition->region_id,$requisition->budget->fiscal_year_id);
            $pipeline =  $budget_attributes['pipeline'];
            $commitment =  $budget_attributes['commitment'];
            $origin_budget =  $budget_attributes['budget'];
           $actual_amount = $budget_attributes['actual_expenditure'];
            $available_amount = $origin_budget - ($commitment + $actual_amount + $pipeline);
            if ($available_amount > $requisition->amount)
            {
                $this->requisitions->updateDoneAssignNextUserIdAndGenerateNumber($requisition);
                $wf_module_group_id = 1;
                $next_user = null;
                switch($requisition->type)
                {
                    case 1:
                        $next_user_id = $requisition->activity->subProgram->users()->first();
                        if(!$next_user_id){
                            throw new GeneralException('Sub Program Area Manager not assigned');
                        }
                        $next_user = $next_user_id->id;
                        break;
                }
                event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $requisition->id,'region_id' => $requisition->region_id, 'type' => $requisition->type],[],['next_user_id' => $next_user]));
                alert()->success(__('Submitted Successfully'), __('Purchase Requisition'));
                return redirect()->route('requisition.show', $requisition->uuid);
            }

            else{

                alert()->error('Insufficient fund', 'Failed');
                return redirect()->route('requisition.initiate', $requisition->uuid);
            }

          });


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $requisition_type_id
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @param $fiscal_year
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResultsJson(Request $request)
    {
        $requisition_type_id = $request->only('requisition_type_id');
        $project_id = $request->only('project_id');
        $activity_id = $request->only('activity_id');
        $region_id = $request->only('region_id');
        $fiscal_year = $request->only('fiscal_year');
        return response()->json($this->requisitions->getResults($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year));
    }

    public function description(Request $request, Requisition $requisition)
    {
        $mdh_rates = $this->mdh_rates->getForPluck();
        $description = $request->input('description');
        $numeric_out_put = $request->input('numeric_out_put');
        $uuid = $request->input('uuid');
        DB::update('update requisitions set descriptions = ?, numeric_output = ? where uuid = ?',[$description,$numeric_out_put, $uuid]);

        return redirect()->route('requisition.initiate',[$requisition])
            ->with('mdh_rates',$mdh_rates->all());
    }
    public function detailed(){

        return view('requisition._parent.detailed');
    }
    public function updateActualAmount(Requisition $requisition)
    {
         $this->requisitions->updateActualAmount($requisition);
         return redirect()->back();

    }




}
