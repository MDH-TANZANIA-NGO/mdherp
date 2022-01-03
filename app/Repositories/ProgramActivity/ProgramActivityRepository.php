<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Repositories\BaseRepository;
use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\Support\Facades\DB;

class ProgramActivityRepository extends BaseRepository
{
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
        //$requisition_id = DB::table('requisition_trainings')->select('requisition_id')->where('id','=', $requisition_training_id);
        //dd($requisition_training['requisition_id']);
        $requisition = Requisition::findOrFail($requisition_training['requisition_id']);

        //dd($requisition->amount);
        //$user_id = access()->user()->id;

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
}
