<?php

namespace App\Http\Controllers\Web\Requisition\Favourite;

use App\Http\Controllers\Controller;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingCostFavouriteRepository;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    protected $training_cost_favourites;
    protected $training_cost;
    protected $gofficer;
    protected $grate;
    protected $requisition;

    public function __construct()
    {
        $this->training_cost_favourites = (new RequisitionTrainingCostFavouriteRepository());
        $this->training_cost = (new RequestTrainingCostRepository());
        $this->gofficer = (new GOfficerRepository());
        $this->grate = (new GRateRepository());
        $this->requisition =  (new RequisitionRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $this->training_cost_favourites->store($request->all());

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buildFromRequisitionTrainingCost(Request $request)
    {

        $training_cost_favourite =  $this->training_cost_favourites->find($request['favourite_id']);

        return view('requisition.Direct.training.datatables.favourites')
            ->with('requisition', $this->requisition->find($training_cost_favourite->requisition_id))
            ->with('gofficer',$this->gofficer->getForPluckUnique())
            ->with('grate',$this->grate->getQuery()->get()->pluck('amount','id'))
            ->with('favourites_costs', $this->training_cost->getParticipantsByRequisition($training_cost_favourite->requisition_id)->get());
    }
}
