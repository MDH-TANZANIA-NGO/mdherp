<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Repositories\BaseRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class ProgramActivityRepository extends BaseRepository
{
    use Number;
    const MODEL = ProgramActivity::class;
    protected $requisition;


    public function __construct()
    {
        //
        $this->requisition =  (new  RequisitionRepository());

    }

    public function inputProcess( $inputs)
    {
        $requisition_training = requisition_training::query()->find($inputs['requisition_training_id']);
        $requisition = Requisition::findOrFail($requisition_training['requisition_id']);

        return[
            'requisition_training_id' => $inputs['requisition_training_id'],
            'user_id'=>  access()->user()->id,
            'requisition_id' => $requisition->id,
            'amount_requested'=>$requisition->amount,
            'amount_paid'=>0,
            'scope'=>'',
            'region_id'=>access()->user()->region_id

        ];
    }
    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($inputs, $uuid)
    {

        return DB::transaction(function () use ($inputs, $uuid){

            $programActivity = $this->findByUuid($uuid);
            $number = $this->generateNumber($programActivity);
            DB::update('update program_activities set number = ?, done = ? where uuid=?', [$number, 1, $uuid]);
        });

    }


    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('program_activities.id AS id'),
            DB::raw('program_activities.user_id AS user_id'),
            DB::raw('program_activities.number AS number'),
            DB::raw('program_activities.amount_requested AS amount_requested'),
            DB::raw('program_activities.amount_paid AS amount_paid'),
            DB::raw('program_activities.created_at AS created_at'),
            DB::raw('program_activities.uuid AS uuid'),
        ])
            ->join('users','users.id', 'program_activities.user_id');
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done_date', null)
            ->where('program_activities.done', 1)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', false)
//            ->where('safari_advances.done', true)
            ->where('program_activities.rejected', true)
            ->where('users.id', access()->id());
    }
    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
//            ->where('safari_advances.done', true)
            ->where('program_activities.rejected', false)
            ->where('users.id', access()->id());
    }
    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', false)
            ->where('program_activities.done', false)
            ->where('program_activities.rejected', false)
            ->where('program_activities.number', null)
            ->where('users.id', access()->id());
    }
    public function getAccessPaidDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('program_activities.wf_done', true)
//            ->where('safari_advances.done', false)
            ->where('program_activities.rejected', false)
            ->where('program_activities.amount_paid', '!=', 0 )
            ->where('users.id', access()->id());
    }

}
