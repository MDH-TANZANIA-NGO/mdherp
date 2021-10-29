<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\RequisitionRequest;
use App\Models\Project\ProjectUser;
use App\Models\Requisition\Requisition;
use App\Repositories\Project\ActivityRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    protected $projects;
    protected $regions;
    protected $activities;
    protected $districts;
    protected $requisitions;

    public function __construct(){
        $this->projects = (new ProjectRepository());
        $this->regions = (new RegionRepository());
        $this->districts = (new DistrictRepository());
        $this->activities = (new ActivityRepository());
        $this->requisitions = (new RequisitionRepository());
    }

    public function index(){
        $userID = Auth::id();
        return ['requisition' => $this->requisitions->getRequisitionsByUserID($userID)];
    }
    public function show(Requisition $requisition){
        return ['requisition', $requisition];
    }

    public function create(){
        $userID = Auth::id();
        return ['regions' => $this->regions->all(), 'projects' => $this->projects->getUserProjects($userID)];
    }

    public function getDistricts($region_id){
        return ['districts' => $this->districts->getByRegion($region_id)];
    }

    public function getProjectActivities($projectID){
        return ['activities' => $this->activities->getProjectActivities($projectID)];
    }

    public function store(RequisitionRequest $request){
        $this->requisitions->store($request->all());
        alert()->success('Requisition Created Successfully','success');
        return redirect()->back();
    }

    public function update(Request $request, Requisition $requisition){
        $this->requisitions->update($request->all(), $requisition);
        return redirect()->back()->with('success','Requisition Updated Successfully');
    }
}
