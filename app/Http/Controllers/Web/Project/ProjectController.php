<?php

namespace App\Http\Controllers\Web\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Project\Traits\ProjectDatatables;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project\Project;
use App\Repositories\Project\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ProjectDatatables;
    protected $projects;

    public function __construct()
    {
        $this->projects = (new ProjectRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('project.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(/*ProjectRequest*/ Request $request)
    {
         $this->projects->store($request->all());
         return redirect()->back()->with('success','Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        return view('project.show')
            ->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $this->projects->update($request->all(), $project);
        return redirect()->back()->with('success','Project Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Request $request, Project $project)
    {
        $this->projects->activate($request->all(), $project);
        return redirect()->back()->with('success','Project Activated Successfully');
    }
}
