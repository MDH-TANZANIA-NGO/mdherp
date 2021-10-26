<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Project\ProjectUser;
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
        ///return ['name' => "William Mussa"]; it works
        return ['regions' => $this->regions->all(), 'projects' => $this->projects->getAll(),'districts' => $this->districts->getAll(), 'activities' => $this->activities->getAll()];
    }
}
