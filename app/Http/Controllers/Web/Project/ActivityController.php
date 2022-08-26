<?php
namespace App\Http\Controllers\Web\Project;

use Illuminate\Http\Request;
use App\Imports\BudgetImport;
use App\Models\Project\Activity;
use App\Exports\ActivitiesExport;
use App\Imports\ActivitiesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Project\ActivityRepository;
use App\Repositories\Project\OutputUnitRepository;
use App\Repositories\Project\SubProgramRepository;
use App\Http\Controllers\Web\Project\Traits\ActivityDatatables;

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
        alert()->success('Activity Registered Successfully');
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
        alert()->success('Activity Updated Successfully');
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
//        $activities =$this->activities->getActivities($request->only('user_id'),$request->only('region_id'),$request->only('project_id'));
        $activities =$this->activities->getActivitiesFilter($request->only('user_id'),$request->only('region_id'),$request->only('project_id'));
        return response()->json($activities);
    }

    public function import(Request $request)
    {
      
        if ($request->hasFile('file')){
            $activities = new ActivitiesImport();
            $import_to_temporary_store = Excel::import($activities, \request()->file('file'));
            alert()->warning('Please confirm imported data', 'Confirm');
            return redirect()->back()
                    ->with('importedRows', $activities->getImportedRowsCount())
                    ->with('importedDuplicates',$activities->getDuplicateRowsCount());
        }
        else{
            alert()->error('You have not attach any file', 'Failed');
            return redirect()->back();
        }
    }
    public function importBudget(Request $request)
    {    
        if ($request->hasFile('file')){
            $activities = new BudgetImport();
            $import_to_temporary_store = Excel::import($activities, \request()->file('file'));
            alert()->warning('Please confirm imported data', 'Confirm');
            return redirect()->back()
                    ->with('importedRows', $activities->getImportedRowsCount())
                    ->with('importedDuplicates',$activities->getDuplicateRowsCount());
        }
        else{
            alert()->error('You have not attach any file', 'Failed');
            return redirect()->back();
        }
    }
}
