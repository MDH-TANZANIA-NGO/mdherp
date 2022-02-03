<?php

namespace App\Http\Controllers\Api\Facility\Web\Project;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Project\Traits\ProgramAreaDatatables;
use App\Models\Project\ProgramArea;
use App\Repositories\Project\ProgramAreaRepository;
use App\Repositories\Project\ProjectRepository;
use Illuminate\Http\Request;

class ProgramAreaController extends Controller
{
    use ProgramAreaDatatables;

    protected $program_areas;
    protected $projects;

    public function __construct()
    {
        $this->program_areas = (new ProgramAreaRepository());
        $this->projects = (new ProjectRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('project.program_area.index')
            ->with('projects', $this->projects->getAll()->pluck('title','id'));
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
        $this->program_areas->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($uuid)
    {
        $program_area = $this->program_areas->findByUuid($uuid);
        return view('project.program_area.show')
            ->with('program_area', $program_area)
            ->with('projects', $this->projects->getAll()->pluck('title','id'))
            ->with('program_area_projects', $program_area->projects()->pluck('projects.id')->toArray());
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
    public function update(Request $request, $uuid)
    {
        $this->program_areas->update($uuid, $request->all());
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
