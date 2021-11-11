<?php

namespace App\Http\Controllers\Web\SupplyChain;


use App\Http\Controllers\Controller;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{

//        Display List of all goods
    public function index(){
//        $goods = Good::latest()->paginate(5);

return view('/SupplyChain.index');

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

    public function  store(Request $request){

        $request -> validate([

            'title' => 'required',
            'quantity'=> 'required',
            'unit_id' => 'required',
            'date_received'=> 'required'
        ]);



        Good::create($request-> all());
        return redirect()->route('SupplyChain.index')->with('success', 'Good Received Successfully');
    }

}

