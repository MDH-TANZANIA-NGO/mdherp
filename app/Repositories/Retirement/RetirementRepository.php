<?php

namespace App\Repositories\Retirement;

use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class RetirementRepository extends BaseRepository
{
    const MODEL = Retirement::class;

    public function __construct()
    {
        //
    }


    public function inputProcess($inputs)
    {
       $safari_advance_id = SafariAdvance::all()->find($inputs['safari_advance_id']);
        return[

            'user_id'=> access()->user()->id,
            'safari_advance_id' => $inputs['safari_advance_id'],
            'amount_requested'=>$safari_advance_id->amount_requested,
            'amount_paid'=>$safari_advance_id->amount_paid,
            'amount_received'=>0,
            'activity_report'=>'',

        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }
}
