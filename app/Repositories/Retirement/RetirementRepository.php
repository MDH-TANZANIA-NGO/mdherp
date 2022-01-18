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
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('retirements.id AS id'),
            DB::raw('retirements.user_id AS user_id'),
            DB::raw('retirements.number AS number'),
            DB::raw('retirements.amount_requested AS amount_requested'),
            DB::raw('retirements.amount_paid AS amount_paid'),
            DB::raw('retirements.created_at AS created_at'),
            DB::raw('retirements.uuid AS uuid'),
        ])
            ->join('users','users.id', 'retirements.user_id');
    }
    public function getAllApprovedRetirements()
    {
        return $this->getQuery()
            ->where('retirements.wf_done', true);
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
