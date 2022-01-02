<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Training\requisition_training;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProgramActivityRepository extends BaseRepository
{
    const MODEL = ProgramActivity::class;
    public function __construct()
    {
        //
    }

    public function inputProcess($inputs)
    {
        $requisition_training_id = requisition_training::query()->find($inputs['requisition_training_id']);
        return[
            'requisition_training_id' => $inputs['requisition_training_id'],
            'user_id'=>  $requisition_training_id->requisition->user_id,
            'amount_requested'=>$requisition_training_id->requisition->total_amount,
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
}
