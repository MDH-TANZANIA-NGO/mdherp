<?php

namespace App\Repositories\HumanResource\HireRequisition;


use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobsCriteria;
use App\Models\System\CodeValue;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HireRequisitionJobCreteriaRepository extends BaseRepository
{
    const MODEL = HrHireRequisitionJobsCriteria::class;


    public function getQuery(){
        return $this->query()->select([
            DB::raw('code_values.name as education_level'),
            DB::raw('hr_hire_requisition_jobs_criterias.experience_years as experience_years'),
            DB::raw('hr_hire_requisition_jobs_criterias.age as age'),
        ]
        )->join('code_values', 'code_values.id', 'hr_hire_requisition_jobs_criterias.education_level');         
    }

     
 
    public function inputsProcessor($inputs)
    {
        return [
            'hr_requisitions_jobs_id' =>  $inputs['hr_requisition_job_id'],
            'education_level' => $inputs['education_level'],
            'experience_years' =>$inputs['experience_years'],
        ];
    }

    public function store($data)
    {    
        $hireRequisitionJob = $this->query()->create($this->inputsProcessor($data));
        return $hireRequisitionJob;   
    }

    public function update($data)
    {    
        $hireRequisitionJob = $this->query()->where('hr_requisitions_jobs_id',$data['hr_requisition_job_id'])->update($this->inputsProcessor($data));
        return $hireRequisitionJob;   
    }
}
