<?php

namespace App\Repositories\HumanResource\Advertisement;

use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Services\Generator\Number;
class AdvertisementRepository extends  BaseRepository
{

    const MODEL = HireAdvertisementRequisition::class;
    use Number;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('hr_hire_advertisement_requisitions.title AS title'),
            DB::raw('hr_hire_advertisement_requisitions.description AS description'),
            DB::raw('hr_hire_advertisement_requisitions.number AS number'),
            DB::raw('hr_hire_advertisement_requisitions.created_at AS created_at'),
            DB::raw('hr_hire_advertisement_requisitions.uuid AS uuid'),
        ]);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_advertisement_requisitions.wf_done', 0)
            ->where('hr_hire_advertisement_requisitions.rejected', false)
            ->where('hr_hire_advertisement_requisitions.user_id', access()->id());
    }

    public function getAccessDeniedDatatable(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_advertisement_requisitions.rejected', true)
            ->where('hr_hire_advertisement_requisitions.user_id', access()->id());
    }


    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_advertisement_requisitions.wf_done', 5)
            ->where('hr_hire_advertisement_requisitions.user_id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('hr_hire_advertisement_requisitions.wf_done', 1)
            ->where('hr_hire_advertisement_requisitions.done', true)
            ->where('hr_hire_advertisement_requisitions.user_id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('hr_hire_advertisement_requisitions.wf_done', 0)
            ->where('hr_hire_advertisement_requisitions.done', 0)
            ->where('hr_hire_advertisement_requisitions.rejected', false)
            ->where('hr_hire_advertisement_requisitions.user_id', access()->id());
    }

    public function inputProcessor($input){
        return [
            'title' => $input['title'],
            'hire_requisition_job_id' => $input['hr_requisition_job_id'],
            'description' =>$input['description'],
            'user_id' =>access()->id()
        ];
    }

    public function store($input){
        return $this->query()->create($this->inputProcessor($input));
    }

    public function submit($hireRequisition)
    {
        $number = $this->generateNumber($hireRequisition);
        $hireRequisition->update([
            'number'=> $number
        ]);
    }

}
