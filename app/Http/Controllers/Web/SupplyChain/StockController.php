<?php

namespace App\Http\Controllers\Web\SupplyChain;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\SupplyChain\Traits\stockDatatable;
use App\Models\SupplyChain\stock;
use App\Models\SupplyChain\stock_unit;
use App\Repositories\SupplyChain\stockRepository;
use Illuminate\Http\Request;

class StockController extends Controller
{
   protected $stocks;
   use stockDatatable;

    public function __construct()
    {
        $this->stocks = (new stockRepository());
    }


    public function index(){

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

        return view('/SupplyChain.index');

    }

    public function create(){
        $units = stock_unit::all();
        return view('SupplyChain.forms.create', ['units'=>$units]);
    }
}
