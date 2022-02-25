<?php

namespace App\Repositories\Leave;

use App\Models\Leave\Leave;
use App\Models\Leave\LeaveBalance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LeaveRepository extends BaseRepository
{
    const MODEL = Leave::class;

    public function __construct(){

    }

    public function getQuery(){
        return $this->query()->select([
            DB::raw('leaves.id AS id'),
            DB::raw('leaves.start_date AS start_date'),
            DB::raw('leaves.end_date AS end_date'),
            DB::raw('leaves.comment AS comment'),
            DB::raw('leaves.uuid AS uuid'),
            DB::raw('leaves.created_at AS created_at'),
            DB::raw('leaves.leave_type_id AS leave_type_id'),
            DB::raw('leave_types.id AS type_id'),
            DB::raw('leaves.employee_id AS employee_id' ),
            DB::raw('leave_types.name AS type_name'),
            DB::raw('leaves.user_id AS user_id'),
            DB::raw('leaves.region_id AS region_id'),
        ])
            ->join('leave_types', 'leave_types.id', 'leaves.leave_type_id')
            ->join('regions', 'regions.id', 'leaves.region_id')
            ->join('users','users.id', 'leaves.user_id');
    }

    public function getQueryAll()
    {
        return $this->query()->select([
            DB::raw('leaves.id AS id'),
            DB::raw('leaves.start_date AS start_date'),
            DB::raw('leaves.end_date AS end_date'),
            DB::raw('leave_balance AS leave_balance'),
            DB::raw('leaves.comment AS comment'),
            DB::raw('leaves.leave_type_id AS leave_type_id')
                ])
            ->join('users','users.id', 'leaves.user_id');
    }

    public function inputProcess($inputs){

        $leave_balance = LeaveBalance::where('user_id', access()->user()->id)->where('leave_id', $inputs['leave_type_id'])->first();

        return [
            'user_id' => access()->id(),
            'region_id' => access()->user()->region_id,
            'department_id'=>access()->user()->designation->department->id,
            'employee_id' => $inputs['employee_id'],
            'comment' => $inputs['comment'],
            'start_date' => $inputs['start_date'],
            'end_date' => $inputs['end_date'],
            'leave_type_id' => $inputs['leave_type_id'],
            'leave_balance' =>$leave_balance->id
        ];
    }


    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs){

            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function getAllApprovedLeaves()
    {
        return$this->getQueryAll()
            ->where('leaves.wf_done', 1);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
//            ->where('leaves.done', true)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 0)
           // ->where('leaves.done', true)
            ->where('leaves.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('leaves.wf_done', 1)
            ->where('leaves.done', true)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessSavedDatatable()
    {
        return $this->getQuery()
            ->whereDoesntHave('wfTracks')
            ->where('leaves.wf_done', 0)
           // ->where('leaves.done', false)
            ->where('leaves.rejected', false)
            ->where('users.id', access()->id());
    }

}
