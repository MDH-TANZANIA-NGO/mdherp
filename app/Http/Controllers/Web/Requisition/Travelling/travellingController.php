<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Travelling\travelling_cost;
use App\Models\System\District;
use Illuminate\Http\Request;

class travellingController extends Controller
{
    protected $travelling_costs;

    public function __construct()
    {

    }

    public function index()
    {
        $user_id = User::all();
        $districts = District::all();
        $mdh_rates = mdh_rate::all();
        return view('requisition.travelling.index',['user_id'=>$user_id,
            'districts'=>$districts,
            'mdh_rates'=>$mdh_rates]);

    }

    public function create()
    {
        $user_id = User::all();
        return view('requisition.travelling.forms.create',['user_id'=>$user_id]);

    }

    public function store( Request $request)
    {
        $travelling = new travelling_cost();
        $other_cost = request('other_cost');
        $no_days = request('no_days');
        $perdiem_rate = request('perdiem_rate');
        $district_id = request('district_id');
        $transportation = request('transportation');
        $accomodation = request('accomodation');
        $total_perdiem_rate = $perdiem_rate * $no_days;
        $total_accomodation = $accomodation * $no_days;
        $total_amount =  $other_cost + $transportation + $total_perdiem_rate + $total_accomodation;


        $travelling-> user_id = request('user_id');
        $travelling->district_id= $district_id;
        $travelling-> perdiem_rate = $perdiem_rate;
        $travelling-> accomodation = $accomodation;
        $travelling-> no_days = $no_days;
        $travelling-> transportation = $transportation;
        $travelling-> other_cost = $other_cost;
        $travelling->total_amount = $total_amount;

        $travelling->save();

        return redirect()->back();

    }

    public function update()
    {

    }

}
