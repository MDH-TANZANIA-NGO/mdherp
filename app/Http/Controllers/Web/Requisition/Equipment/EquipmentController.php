<?php

namespace App\Http\Controllers\Web\Requisition\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Requisition\Equipment\datatables\EquipmentDatatables;
use App\Http\Requests\Requisition\Equipment\EquipmentRequest;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\Equipment\EquipmentTypeRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    use EquipmentDatatables, InitiatorBudgetChecker;
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
            ->with('equipment_type_pluck', $this->equipment_types->getForPluck())
            ->with('equipment_types', $this->equipment_types->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        $this->equipments->store($request->all());
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
    public function update(EquipmentRequest $request, $uuid)
    {
        $this->equipments->update($uuid, $request->all);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        $requisition = Requisition::query()->where('uuid', $request->input('uuid'))->first();
        $data = [
            'equipment' => $this->equipments->getById($request->all()),
            'budget_summary' => $this->check($requisition->requisition_type_id, $requisition->project_id, $requisition->activity_id, $requisition->region_id, null)
        ];
        return response()->json($data);
    }
}
