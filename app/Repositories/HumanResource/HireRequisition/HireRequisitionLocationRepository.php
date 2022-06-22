<?php
namespace App\Repositories\HumanResource\HireRequisition;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Repositories\BaseRepository;
class HireRequisitionLocationRepository extends BaseRepository
{
    const MODEL = HireRequisitionLocation::class;

    public function inputProcessor($input){
        return [
            'user_id' => access()->id(),
            'hr_requisition_job_id' => $input['hire_requisition_job_id']
        ];
    }

    public function store($input){
        return $this->query()->create($this->inputProcessor($input));
    }

    public function update($input){
        $regions = $input['region'];        
        $this->query()->where('hr_requisition_job_id',$input['hr_requisition_job_id'])->delete();
        foreach($regions as $region){
            $data['hr_requisition_job_id'] = $input['hr_requisition_job_id'];
            $data['region_id'] = $region;
            $this->query()->create($data);
        }         
    }

}
