<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Models\HumanResource\HireRequisition\HireRequisitionReplacedStaff;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
class HireRequisitionReplacedStaffRepository extends BaseRepository
{
    const MODEL = HireRequisitionReplacedStaff::class;

    public function inputProcessor($input){
        return [
            'user_id' => access()->id(),
            'hr_requisition_job_id' => $input['hr_requisition_job_id']
        ];
    }

    public function store($input){
        return $this->query()->create($this->inputProcessor($input));
    }

    public function update($input){
        // dd($this->inputProcessor($input));
        $this->query()->where('hr_requisition_job_id',$input['hr_requisition_job_id'])->delete();
        return $this->query()->create($this->inputProcessor($input));
    }

}
