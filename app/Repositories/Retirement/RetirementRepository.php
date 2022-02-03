<?php

namespace App\Repositories\Retirement;

use App\Http\Controllers\Api\Facility\Web\Retirement\Datatables\RetirementDatatables;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;


class RetirementRepository extends BaseRepository
{
    use Number;
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

    public function getAccessProcessingRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done_date', null)
            ->where('retirements.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done', 0)
            ->where('retirements.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('retirements.wf_done', true)
            ->where('retirements.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedRetirementDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('retirements.wf_done', false)
            ->where('retirements.done', false)
            ->where('retirements.rejected', false)
            ->where('retirements.number', null)
            ->where('users.id', access()->id());
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
            $retire = $this->findByUuid($uuid);
            $number = $this->generateNumber($retire);
            DB::update('update retirements set number= ? where uuid= ?',[$number, $uuid]);

            DB::table('retirement_details')->insert(
                [
                    'retirement_id'=> $retire->id,
                    'safari_advance_id'=>$inputs['safari_advance_id'],
                    'number' => $number,
                    'from'=>$inputs['from'],
                    'to'=>$inputs['to'],
                    'district_id'=>$inputs['district_id'],
                    'amount_requested'=>$inputs['amount_requested'],
                    'amount_paid'=>$inputs['amount_paid'],
                    'amount_received'=>$inputs['amount_received'],
                    'amount_spent'=>$inputs['amount_spent'],
                    'amount_variance'=>$inputs['amount_variance'],
                    'activity_report'=>$inputs['activity_report'],
                ]
            );
        });
    }

}
