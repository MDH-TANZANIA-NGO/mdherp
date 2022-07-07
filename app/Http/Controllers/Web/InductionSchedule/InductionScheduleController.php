<?php

namespace App\Http\Controllers\Web\InductionSchedule;

use App\Http\Controllers\Controller;
use App\Models\InductionSchedule\InductionSchedule;
use App\Models\InductionSchedule\InductionScheduleItem;
use App\Models\InductionSchedule\InductionScheduleParticipant;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DepartmentRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Services\Generator\Number;
use Illuminate\Http\Request;

class InductionScheduleController extends Controller
{
    use Number;

    protected $designations;
    protected $departments;

    /**
     * @param $designations
     */
    public function __construct()
    {
        $this->designations = (new DesignationRepository())->getNewStaffDesignations();
        $this->departments = (new DepartmentRepository())->getForSelect();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('induction._parent.index');
    }

    public function initiate(){

        return view('induction._parent.forms.initiate')
            ->with('designations', $this->designations);
    }

    public function storeSchedule(Request $request){
        $inductionSchedule = InductionSchedule::create([
            'designation_id' => $request->get('designation_id'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date')
        ]);

        alert()->success('Induction Schedule created Successfully');
        return redirect()->route('induction_schedule.create', $inductionSchedule);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(InductionSchedule $inductionSchedule)
    {
        $inductionScheduleItems = InductionScheduleItem::where('induction_schedule_id', $inductionSchedule->id)->get();
        //dd($inductionScheduleItems);
        return view('induction._parent.forms.create')
            ->with('inductionScheduleItems', $inductionScheduleItems)
            ->with('inductionSchedule', $inductionSchedule)
            ->with('departments', $this->departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $md = new \ParsedownExtra();
        //dd($request->all());
        $inductionScheduleItem = InductionScheduleItem::create([
            'induction_schedule_id' => $request->get('induction_schedule_id'),
            'department_id' => $request->get('department_id'),
            'date' => $request->get('date'),
            'area' => $md->text($request->get('area'))
        ]);

        alert()->success('Induction Schedule Item have been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(InductionScheduleItem $inductionScheduleItem)
    {
        return view('induction._parent.display.show')
            ->with('departments', $this->departments)
            ->with('inductionScheduleItem', $inductionScheduleItem);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, InductionScheduleItem $inductionScheduleItem)
    {
        $inductionScheduleItem->update($request->all());

        alert()->success('Induction Schedule Item have been updated');
        return redirect()->route('induction_schedule.create', $inductionScheduleItem->inductionSchedule);

    }

    public function addParticipants(InductionSchedule $inductionSchedule){
        $participants = (new UserRepository())->getNewStaffByDesignationId($inductionSchedule->designation_id);

        return view('induction._parent.forms.add')
            ->with('inductionSchedule', $inductionSchedule)
            ->with('participants', $participants);
    }

    public function participants(Request $request){
        foreach ($request->input('participants') as $participant){
            InductionScheduleParticipant::create([
                'induction_schedule_id' => $request->get('induction_schedule_id'),
                'user_id' => $participant
            ]);
        }
        alert()->success('Induction Schedule Participants have been added');
        return redirect()->route('induction_schedule.index');
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
