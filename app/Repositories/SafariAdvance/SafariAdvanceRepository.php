<?php

namespace App\Repositories\SafariAdvance;

use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SafariAdvanceRepository extends BaseRepository
{
    const MODEL = SafariAdvance::class;
    public function __construct()
    {
        //
    }


    public function inputProcess($inputs)
    {
        $requisition_travelling_cost = requisition_travelling_cost::query()->find($inputs['requisition_travelling_cost_id']);
        return[
            'requisition_travelling_cost_id' => $inputs['requisition_travelling_cost_id'],
            'user_id'=> $requisition_travelling_cost->traveller_uid,
            'amount_requested'=>$requisition_travelling_cost->total_amount,
            'amount_paid'=>0,
            'scope'=>'',

        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }
}
