<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\RequisitionType\RequisitionTypeRepository;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    protected $requisitions;
    protected $requisition_types;
    protected $projects;
    protected $equipments;

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->requisition_types = (new RequisitionTypeRepository());
        $this->projects = (new ProjectRepository());
        $this->equipments = (new EquipmentRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requisition._parent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('requisition._parent.form.create')
            ->with('requisition_types', $this->requisition_types->getAll()->pluck('title','id'))
            ->with('projects', $this->projects->getAccessUserProjectsPluck());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $requisition = $this->requisitions->store($request->all());
        return redirect()->route('requisition.initiate',[$requisition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initiate(Requisition $requisition)
    {
        return view('requisition._parent.form.initiate')
            ->with('requisition', $requisition)
            ->with('equipments', $this->equipments->getQuery()->get()->pluck('title','id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
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
     * @param $requisition_type_id
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @param $fiscal_year
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResultsJson(Request $request)
    {
        $requisition_type_id = $request->only('requisition_type_id');
        $project_id = $request->only('project_id');
        $activity_id = $request->only('activity_id');
        $region_id = $request->only('region_id');
        $fiscal_year = $request->only('fiscal_year');
        return response()->json($this->requisitions->getResults($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year));
    }

    public function detailed(){

        return view('requisition._parent.detailed');
    }
}
