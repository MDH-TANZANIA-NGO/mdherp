<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
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

    public function store()
    {

    }

    public function update()
    {

    }

}
