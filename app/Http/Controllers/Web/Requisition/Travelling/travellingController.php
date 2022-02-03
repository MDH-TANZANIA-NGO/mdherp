<?php

namespace App\Http\Controllers\Api\Facility\Web\Requisition\Travelling;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Requisition\Travelling\Traits\travellingCostsDatatable;
use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Travelling\travelling_cost;
use App\Models\System\District;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\Travelling\travellingRepository;
use Illuminate\Http\Request;

class travellingController extends Controller
{
    use travellingCostsDatatable;
    protected $travelling_costs;
    protected $mdh_rates;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->travelling_costs = (new travellingRepository());
    }

    public function index()
    {
        $user_id = User::all();
        $districts = District::all();
        $mdh_rates = mdh_rate::all();
        dd($mdh_rates);
        return view('requisition.travelling.index',['user_id'=>$user_id,
            'districts'=>$districts,
            'mdh_rates'=>$mdh_rates]);

    }

    public function create()
    {
        $user_id = User::all();
        return view('requisition.travelling.forms.create')
            ;

    }

    public function store( Request $request, Request $requisition)
    {
        $this->travelling_costs->store($requisition, $request->all());
        return redirect()->back();

    }

    public function update()
    {

    }

}
