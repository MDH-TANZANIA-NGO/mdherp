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

}
