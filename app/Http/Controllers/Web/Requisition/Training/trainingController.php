<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Requisition\Training\Traits\trainingCostsDatatable;
use App\Models\Auth\User;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GRate;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Training\training_cost;
use App\Models\System\District;
use App\Repositories\Requisition\Training\trainingRepository;
use Illuminate\Http\Request;

class trainingController extends Controller
{
    use trainingCostsDatatable;
    protected $training_costs;

    public function __construct()
    {
        $this->training_costs = (new trainingRepository());
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

    public function store(Request $request)
    {
        $training = new training_cost();
        $other_cost = request('other_cost');
        $no_days = request('no_days');
        $perdiem_rate = request('perdiem_rate');
        $district_id = request('district_id');
        $transportation = request('transportation');
        $total_perdiem_rate = $perdiem_rate * $no_days;
        $total_amount =  $other_cost + $transportation + $total_perdiem_rate;


        $training-> user_id = request('user_id');
        $training->district_id= $district_id;
        $training-> perdiem_rate = $perdiem_rate;
        $training-> no_days = $no_days;
        $training-> transportation = $transportation;
        $training-> other_cost = $other_cost;
        $training->total_amount = $total_amount;

        $training->save();

        return redirect()->back();
    }

    public function update()
    {

    }

}
