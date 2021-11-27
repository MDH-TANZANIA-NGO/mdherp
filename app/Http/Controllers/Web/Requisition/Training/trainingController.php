<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Requisition\Training\Traits\trainingCostsDatatable;
use App\Models\Auth\User;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GRate;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\training_cost;
use App\Models\System\District;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\Requisition\Training\trainingRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;

class trainingController extends Controller
{
    use trainingCostsDatatable;
    protected $requisition_training_cost;
    protected $gofficer;
    protected $districts;
    protected $mdh_rates;


    public function __construct()
    {

        $this->requisition_training_cost = (new requisition_training_cost());
        $this->districts = (new DistrictRepository());
        $this->mdh_rates = (new GRateRepository());
        $this->gofficer = (new GOfficerRepository());

    }

    public function index()
    {
        $user_id = GOfficer::all();
        $districts = District::all();
        $mdh_rates = GRate::all();
        return view('requisition.training.index',['user_id'=>$user_id,
            'districts'=>$districts,
            'mdh_rates'=>$mdh_rates]);

    }

    public function create()
    {

    }

    public function show($uuid)
    {


        return view('requisition.training.show')
            ->with('mdh_rates', $this->mdh_rates->getForPluck())
            ->with('districts',$this->districts->forSelect())
            ->with('training_cost', $this->requisition_training_cost->findByUuid($uuid));
    }

    public function store(Request $request)
    {
        $training = new requisition_training_cost();
        $other_cost = request('other_cost');
        $no_days = request('no_days');
        $perdiem_rate_id = request('perdiem_rate');
        $perdiem_rate_amount = request('perdiem_rate');
        $district_id = request('district_id');
        $transportation = request('transportation');
        $total_perdiem_rate = $perdiem_rate_amount * $no_days;
        $total_amount =  $other_cost + $transportation + $total_perdiem_rate;


        $training-> participant_uid = request('user_id');
        $training->district_id= $district_id;
        $training-> perdiem_rate_id = $perdiem_rate_id;
        $training-> no_days = $no_days;
        $training-> transportation = $transportation;
        $training-> other_cost = $other_cost;
        $training->total_amount = $total_amount;
        $training->delet = '2021-11-24 11:41:26';
        $training->description = 'hhsdhjs';
        $training->save();

        return redirect()->back();
    }

    public function update(Request $request, $uuid)
    {
        $user_id = GOfficer::all();
        $districts = District::all();
        $mdh_rates = GRate::all();
        $this->requisition_training_cost->update($uuid, $request->all());
        return view('requisition.training.index',['user_id'=>$user_id,
            'districts'=>$districts,
            'mdh_rates'=>$mdh_rates]);
    }

}
