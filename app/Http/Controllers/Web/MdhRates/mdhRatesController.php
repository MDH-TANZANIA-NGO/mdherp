<?php

namespace App\Http\Controllers\Web\MdhRates;

use App\Http\Controllers\Controller;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mdhRatesController extends Controller
{
    //
    protected $mdh_rates;
    protected $regions;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->regions = (new RegionRepository());
    }

    public function index(){

        return view('mdh-rates.index')
            ->with('mdh_rates', $this->mdh_rates->getForPluck());
    }
   public function getRegions(){

       return $this->regions->getAll();
   }
    public function storeRates( Request $request){
        $this->mdh_rates->store($request->all());
        return redirect()->back();
    }
    public function assignRate(Request $request)
    {
        $this->mdh_rates->assignRate($request->all());
        return redirect()->back();
    }
}
