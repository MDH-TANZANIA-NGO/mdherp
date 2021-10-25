<?php

namespace App\Http\Controllers\Web\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Project\Traits\SubProgramDatatables;
use App\Models\Project\SubProgram;
use App\Repositories\Project\ProgramAreaRepository;
use App\Repositories\Project\SubProgramRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubProgramController extends Controller
{
    use SubProgramDatatables;

    protected $sub_programs;
    protected $program_areas;

    public function __construct()
    {
        $this->sub_programs = (new SubProgramRepository());
        $this->program_areas = (new ProgramAreaRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('project.sub_program.index')
            ->with('program_areas', $this->program_areas->getActive()->pluck('title','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->sub_programs->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SubProgram $subProgram)
    {
        return view('project.sub_program.show')
            ->with('sub_program',$subProgram)
            ->with('program_areas', $this->program_areas->getActive()->pluck('title','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SubProgram $subProgram
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SubProgram $subProgram)
    {
        $this->sub_programs->update($subProgram, $request->all());
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function byProject(Request $request)
    {
        Log::info($request->only('project_ids'));
//        return response()->json($this->sub_programs->getByProject($request->only('project_ids')));
    }
}
