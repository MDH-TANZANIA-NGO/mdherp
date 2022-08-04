<?php

namespace App\Http\Controllers\Web\Requisition\Favourite;

use App\Http\Controllers\Controller;
use App\Repositories\Requisition\Training\RequisitionTrainingCostFavouriteRepository;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    protected $training_cost_favourites;

    public function __construct()
    {
        $this->training_cost_favourites = (new RequisitionTrainingCostFavouriteRepository());
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

        $training_cost_favourite =  $this->training_cost_favourites->find($request['id']);

        return view('requisition.Direct.training.favourites')
            ->with('favourites_costs', $this->training_cost->getParticipantsByRequisition($training_cost_favourite->requisition_id)->get());
    }
}
