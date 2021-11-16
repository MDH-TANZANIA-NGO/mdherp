<?php

namespace App\Http\Controllers\Web\Requisition\Equipment;

use App\Http\Controllers\Controller;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\Equipment\EquipmentTypeRepository;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    protected $equipments;
    protected $equipment_types;

    public function __construct()
    {
        $this->equipments = (new EquipmentRepository());
        $this->equipment_types = (new EquipmentTypeRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('requisition.equipment.index')
            ->with('equipment_types', $this->equipment_types->getForPluck());
    }

    /**
     * Show the form for creating a new resource.
     * z
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
