<?php

namespace App\Http\Controllers\Api\Facility\Web\Project;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Project\Traits\OutputUnitDatatables;
use App\Models\Project\OutputUnit;
use App\Repositories\Project\OutputUnitRepository;
use Illuminate\Http\Request;

class OutputUnitController extends Controller
{
    use OutputUnitDatatables;

    protected $output_units;

    public function __construct()
    {
        $this->output_units = (new OutputUnitRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.output_unit.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->output_units->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param OutputUnit $outputUnit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($uuid)
    {
        return view('project.output_unit.show')
            ->with('output_unit', $this->output_units->findByUuid($uuid));
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
     * @param \Illuminate\Http\Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $this->output_units->update($uuid, $request->all());
        return redirect()->back();
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
