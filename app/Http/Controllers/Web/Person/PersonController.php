<?php

namespace App\Http\Controllers\Web\Person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\Datatables\UserDatatables;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\Employee\Employee;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{



    protected $designations;
    protected $regions;
    protected $users;
    protected $projects;
    protected $permissions;

    public function __construct()
    {
        $this->designations = (new DesignationRepository());
        $this->regions = (new RegionRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $user = access()->user();
        $employee = Employee::where('user_id', $user->id)->first();
        return view('person.index')
            ->with('user', $user)
            ->with('employee', $employee)
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('marital', code_value()->query()->where('code_id',3)->pluck('name','id'))
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createHealth()
    {
        return view('person.health');
    }

    public function health(Request $request){
        $user_id = access()->id();
        Employee::create([
            'user_id' => $user_id,
            'blood_group' => $request['blood_group'],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'national_id' => $request['national_id'],
            'drivers_licence' => $request['drivers_licence'],
            'passport_no' => $request['passport_no'],
            'nssf_reg_no' => $request['nssf_reg_no']
        ]);
        return redirect()->back();
    }

    public function updateHealth(Request $request, Employee $employee){
        dd($employee);
        $employee->update($request->all());
        return redirect()->back();
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
