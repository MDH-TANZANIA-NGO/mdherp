<?php

namespace App\Http\Controllers\Api\Facility\Web\Project;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Project\Traits\ActivityDatatables;
use App\Models\Project\Activity;
use App\Repositories\Project\ActivityRepository;
use App\Repositories\Project\OutputUnitRepository;
use App\Repositories\Project\SubProgramRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    use ActivityDatatables;

    protected $activities;
    protected $sub_programs;
    protected $output_units;

    public function __construct()
    {
        $this->activities = (new ActivityRepository());
        $this->sub_programs = (new SubProgramRepository());
        $this->output_units = (new OutputUnitRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //dd($this->activities->getAll());
        return view('project.activity.index')
            ->with('program_areas', $this->sub_programs->getActive()->pluck('title','id'))
            ->with('output_unit', $this->output_units->getActive()->pluck('title','id'));
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
        $this->activities->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Activity $activity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Activity $activity)
    {
        return view('project.activity.show')
            ->with('activity', $activity)
            ->with('sub_programs', $this->sub_programs->getActive()->pluck('title','id'))
            ->with('output_unit', $this->output_units->getActive()->pluck('title','id'));
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
     * @param Activity $activity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Activity $activity)
    {
        $this->activities->update($activity, $request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActivitiesJson(Request $request)
    {
        $activities =$this->activities->getActivities($request->only('user_id'),$request->only('region_id'),$request->only('project_id'));
        return response()->json($activities);
    }
}
