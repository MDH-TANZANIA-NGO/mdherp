<?php

namespace App\Http\Controllers\Web\SupplyChain;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\SupplyChain\Traits\stock_unitDatatable;
use App\Models\SupplyChain\stock;
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

return view('/SupplyChain.index');

    }
    public function storeStock(Request $request){
        $stock = new stock();
        $stock-> expense_id = request('expense_id');
        $stock->title= request('title');
        $stock-> unit_id = request('unit_id');
        $stock-> description = request('description');
        $stock-> date_received = request('date_received');
        $stock-> quantity = request('quantity');
        $stock->save();

        return redirect()->back();

    }

//    Shows the form for new received goods
    public function create(){
        $units = stock_unit::all();
        return view('SupplyChain.forms.create', ['units'=>$units]);
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

