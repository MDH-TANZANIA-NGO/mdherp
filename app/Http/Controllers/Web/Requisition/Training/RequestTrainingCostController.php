<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\Training\RequisitionTrainingCostRequest;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Training\training;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestTrainingCostController extends Controller
{
    protected $gofficers;
    protected $grates;
    protected $trainingCost;
    protected $training;
    protected $trainingItem;


    public function __construct()
    {
        $this->gofficers = (new GOfficerRepository());
        $this->grates = (new GRateRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
        $this->trainingItem = (new RequisitionTrainingItemsRepository());
        $this->training =  (new RequisitionTrainingRepository());
    }

    public function index(){

        return view('requisition.Direct.training.index');

    }

    public function store(Request $request, Requisition $requisition){

        $participants =  $request['participant_uid'];


        foreach ($participants as $participant)
        {
            $inputs = [
                'requisition_training_id' => $request['requisition_training_id'],
                'participant_uid'=> $participant,
                'perdiem_rate_id'=> $request['perdiem_rate_id'],
                'transportation'=> $request['transportation'],
                'other_cost'=> $request['other_cost'],
                'others_description'=> $request['others_description']

            ];


            $this->trainingCost->store($requisition, $inputs);
        }

        return redirect()->back();

    }

    public function create(){

        return view('requisition.Direct.training.forms.create')
            ->with('grates',$this->grates->getAll()->pluck('id','amount'))
            ->with('gofficers', $this->gofficers->getForPluckUnique());

    }

    public function show(){


    }

    public function update(){


    }
    public function storeTraining(Requisition $requisition,Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $days = getNoDays($from, $to);

        $training = new requisition_training();
        $training-> requisition_id = request('requisition_id');
        $training-> district_id = request('district_id');
        $training-> start_date = request('from');
        $training-> end_date = request('to');
        $training->no_days = $days;
        $training->save();


        return redirect()->back();
    }

    public function storeTrainingItems(Request $request, Requisition $requisition){

        $this->trainingItem->store($requisition, $request->all());
        return redirect()->back();

    }
    public function removeItem( $uuid)
    {
        $requisition_training_item = requisition_training_item::query()->where('uuid', $uuid)->first();
        $requisition = Requisition::query()->where('id', $requisition_training_item->requisition_id)->first();


        return DB::transaction(function () use ($requisition,$requisition_training_item, $uuid){
            $current_total =  $requisition->amount;
//                check_available_budget_individual($requisition, $requisition_training_item->total_amount,$requisition_training_item->total_amount, 0 );
                DB::delete('delete from requisition_training_items where uuid = ?',[$uuid]);
                $requisition->updatingTotalAmount();
                $new_total =  $requisition->amount;
                add_actual_amount_on_requisition_fund_checker($requisition->id, $current_total, $new_total);
            return redirect()->back();
        });
    }

    public function removeParticipant( $uuid)
    {
        $training_cost = requisition_training_cost::query()->where('uuid', $uuid)->first();
        $requisition =  Requisition::query()->where('id', $training_cost->requisition_id)->first();
        return DB::transaction(function () use ($requisition, $training_cost, $uuid){
            $current_total =  $requisition->amount;
//            check_available_budget_individual($requisition, $training_cost->total_amount, $training_cost->total_amount, 0);
            DB::delete('delete from requisition_training_costs where uuid = ?',[$uuid]);
            $requisition->updatingTotalAmount();
            $new_total =  $requisition->amount;
            add_actual_amount_on_requisition_fund_checker($requisition->id, $current_total, $new_total);
            return redirect()->back();
        });
    }
    public function updateSchedule(Request $request, $uuid)
    {

        $this->training->update($uuid, $request);
        return redirect()->back();



    }

    public function updateBulk(Request $request)
    {

        foreach ($request['participant_uid'] as $key=> $user)
        {
            $data = [];
            $data = [
                'participant_uid'=>$request['participant_uid'][$key],
                'requisition_training_id'=>$request['requisition_training_id'][$key],
                'uuid'=>$request['uuid'][$key],
                'transportation'=>$request['transportation'][$key],
                'other_cost'=>$request['other_cost'][$key],
                'others_description'=>$request['others_description'][$key],
                'perdiem_rate_id'=>$request['perdiem_rate_id'][$key],
            ];
          $training_cost =   $this->trainingCost->findByUuid($request['uuid'][$key]);
           $this->trainingCost->update($training_cost, $data);
        }

        alert()->success('Data saved successfully', 'Success');

        return redirect()->route('requisition.initiate', $request['requisition_uuid']);
    }

    public function payBulk(Request $request)
    {

        foreach ($request['uuid'] as $key=> $uuid) {
            $data =  [];

            if ($request['substitute_participant'][$key] != null){
                $data = [
                    'amount_paid'=>$request['amount_paid'][$key],
                    'substitute_participant'=>$request['substitute_participant'][$key],
                    'current_participant'=>$request['current_participant'][$key],
                    'uuid'=>$request['uuid'][$key],
                    'remarks'=>$request['remarks'][$key],
                    'account_no'=>$request['account_no'][$key],
                ];
            }
            else{
                $data = [
                    'amount_paid'=>$request['amount_paid'][$key],
                    'substitute_participant'=>null,
                    'uuid'=>$request['uuid'][$key],
                    'remarks'=>$request['remarks'][$key],
                    'account_no'=>$request['account_no'][$key],
                ];
            }

            $this->trainingCost->payWithSwap($request['uuid'][$key], $data);
       }
        alert()->success('Payment saved successfully', 'Success');
        return redirect()->back();

    }
    public function removeAllParticipant($requisition_id)
    {

        $training_cost =  $this->trainingCost->getParticipantsByRequisition($requisition_id)->get();

        foreach ($training_cost as $costs)
        {
            $this->trainingCost->findByUuid($costs->uuid)->forceDelete();
        }
        alert()->success('Participants cleared successfully','Success');
        return redirect()->back();
    }

}

