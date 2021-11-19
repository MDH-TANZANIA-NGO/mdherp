<?php

namespace App\Http\Controllers\Web\SupplyChain;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\SupplyChain\Traits\stock_unitDatatable;
use App\Models\SupplyChain\stock_unit;
use App\Repositories\SupplyChain\stockUnitRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
use stock_unitDatatable;

//        Display List of all goods
    protected $stock_units;

    public function __construct(stockUnitRepository $stock_units)
    {
        $this->stock_units = $stock_units;
    }

    public function index(){
//        $goods = Good::latest()->paginate(5);
            $units = stock_unit::all();
return view('/SupplyChain.index', ['units'=>$units]);

    }

//    Shows the form for new received goods
    public function create(){
        return view('SupplyChain.create');
    }
//configure stock unit

    public function stockUnit(){

        return view('/SupplyChain.units.index');
    }


//    Store data inserted from goods form


    public function storeUnit(Request $request){


        $stock_unit = new stock_unit();

        $stock_unit->title = request('title');
        $stock_unit->abbreviation = request('abbreviation');

        $stock_unit->save();

        return redirect()->back();

    }




}

