<?php

namespace App\Http\Controllers\Api\Facility\Api\Project;

use App\Http\Controllers\Api\Facility\Api\BaseController;
use App\Repositories\Project\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends BaseController
{
    protected $activities;

    public function __construct()
    {
        $this->activities = (new ActivityRepository());
    }

    public function getActivitiesDetailsOnProjectInitiations(Request $request)
    {
        $activities = $this->activities->getActivities($request->only('user_id'),$request->only('region_id'),$request->only('project_id'));
        $results['activity_details'] = $activities;
        return $this->sendResponse($results,'User Logout Successfully');;
    }
}
