<?php

namespace App\Http\Controllers\Api\Facility\Web\SupplyChain;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\SupplyChain\Traits\stock_unitDatatable;
use App\Models\SupplyChain\stock_unit;
use App\Repositories\SupplyChain\stockUnitRepository;
use Illuminate\Http\Request;

class StockUnitController extends Controller
{
   use stock_unitDatatable;

   protected $stock_units;

    public function __construct(stockUnitRepository $stock_units)
    {
        $this->stock_units = $stock_units;
    }

    public function stockUnit(){

        return view('/SupplyChain.units.index');
    }

    public function storeUnit(Request $request){


        $stock_unit = new stock_unit();

        $stock_unit->title = request('title');
        $stock_unit->abbreviation = request('abbreviation');

        $stock_unit->save();

        return redirect()->back();

    }
}
