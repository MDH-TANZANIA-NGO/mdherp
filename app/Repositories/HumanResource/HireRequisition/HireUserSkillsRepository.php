<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\SkillUser;
use App\Repositories\BaseRepository;
class HireUserSkillsRepository extends BaseRepository
{
    const MODEL = SkillUser::class;

    public function getQuery(){
        return $this->query();
    }

    public function inputProcessor($input){
        return [
            'hr_requisition_job_id' => $input['hr_requisition_job_id'],
            'skill_id' => $input,
        ];
    }

    public function store($inputs){
        
        if(is_array($inputs['skills'])){
            foreach($inputs['skills'] as $input){
                $this->query()->create(['skill_id'=>$input,'hr_requisition_job_id'=>$inputs['hr_requisition_job_id']]);
            }
        }   
    }

    public function update($inputs){
        $skills = $inputs['skills'];
        $this->query()->where('hr_requisition_job_id',$inputs['hr_requisition_job_id'])->delete();
        if(is_array($inputs)){
            foreach($skills  as $skill ){
                $data['hr_requisition_job_id'] = $inputs['hr_requisition_job_id'];
                $data['skill_id'] = $skill;
                $this->query()->create($data);
            }
        }   
        
    }

}
