<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
class HireRequisitionWorkingToolRepository extends BaseRepository
{
    const MODEL = HireRequisitionWorkingTool::class;

  
    public function store($workingTools)
    {
        $tools = $workingTools['tools'];
        foreach($tools as $tool){
            $data['working_tool_id'] = $tool;
            $data['hr_requisitions_jobs_id'] = $workingTools['hire_requisition_job_id'];
            $this->query()->create($data);
        }
    }

}
