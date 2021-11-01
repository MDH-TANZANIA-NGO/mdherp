<?php

namespace App\Repositories\Requisition;

use App\Models\Project\Project;
use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionRepository extends BaseRepository {
    const MODEL = Requisition::class;

    /**
     * @return mixed
     */
    public function getQuery(){
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.description AS description'),
            DB::raw('activities.title AS title'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
            DB::raw('districts.name AS district'),
            DB::raw('activities.title AS title'),
            DB::raw('requisitions.requested_amount AS amount'),
            DB::raw('requisitions.numerical_output AS numerical_output'),
            DB::raw('requisitions.status AS status'),
            DB::raw('requisitions.created_at AS created_at'),
            DB::raw('requisitions.type AS type'),


        ])
            ->join('activities', 'activities.id', 'requisitions.activity_id')
            ->join('users', 'users.id', 'requisitions.user_id')
            ->join('districts', 'districts.id', 'requisitions.district_id')
            ->groupBy([
                'requisitions.id',
                'requisitions.description',
                'activities.title',
                'users.first_name',
                'districts.name',
                'requisitions.requested_amount',
                'requisitions.numerical_output',
                'requisitions.status',
                'requisitions.type',
                'requisitions.created_at'
            ]);
    }

    /**
     * Get All Requisitions
     * @return mixed
     */
    public function getActive()
    {
        return $this->getQuery();
    }

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'description' => $inputs['description'],
            'activity_id' => $inputs['activity_id'],
            'user_id' => $inputs['user_id'],
            'requested_amount' => $inputs['requested_amount'],
            'district_id' => $inputs['district_id'],
            'numerical_output' => $inputs['numerical_output'],
            'type' => $inputs['type'],
        ];
    }

    /**
     * Store new Project
     * @param $inputs
     * @return mixed
     */
    public function store($inputs){
        return DB::transaction(function () use($inputs){
            $requisition = $this->query()->create($this->inputsProcessor($inputs));
            return $requisition;
        });
    }
    public function update($inputs, Requisition $requisition)
    {
        return DB::transaction(function () use($inputs, $requisition){
            $requisition->update($this->inputsProcessor($inputs));
            return $requisition;
        });
    }

    public function getRequisitionsByUserID($userID){
        return $this->query()->select([
            DB::raw('requisitions.id AS id'),
            DB::raw('requisitions.description AS description'),
            DB::raw('activities.title AS title'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as name"),
            DB::raw('districts.name AS district'),
            DB::raw('activities.title AS title'),
            DB::raw('requisitions.requested_amount AS amount'),
            DB::raw('requisitions.numerical_output AS numerical_output'),
            DB::raw('requisitions.status AS status'),
            DB::raw('requisitions.created_at AS created_at'),
            DB::raw('requisitions.type AS type'),
        ])
            ->join('activities', 'activities.id', 'requisitions.activity_id')
            ->join('users', 'users.id', 'requisitions.user_id')
            ->join('districts', 'districts.id', 'requisitions.district_id')
            ->where('users.id', $userID)
            ->groupBy([
                'requisitions.id',
                'requisitions.description',
                'activities.title',
                'users.first_name',
                'users.last_name',
                'districts.name',
                'requisitions.requested_amount',
                'requisitions.numerical_output',
                'requisitions.status',
                'requisitions.type',
                'requisitions.created_at'
            ])
            ->get();
    }

}
