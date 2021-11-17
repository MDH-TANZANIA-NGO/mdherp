<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\RequisitionType\RequisitionTypeRepository;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    protected $requisitions;
    protected $requisition_types;
    protected $projects;

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->requisition_types = (new RequisitionTypeRepository());
        $this->projects = (new ProjectRepository());
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requisition._parent.form.create')
            ->with('requisition_types', $this->requisition_types->getAll()->pluck('name','id'));
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
