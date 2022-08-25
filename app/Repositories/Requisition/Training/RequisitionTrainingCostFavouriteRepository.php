<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\RequisitionTrainingCostFavourite;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTrainingCostFavouriteRepository extends BaseRepository
{
    const MODEL = RequisitionTrainingCostFavourite::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_training_cost_favourites.id AS id'),
            DB::raw('requisition_training_cost_favourites.user_id AS user_id'),
            DB::raw('requisition_training_cost_favourites.requisition_id AS requisition_id'),
            DB::raw('requisition_training_cost_favourites.name AS name'),
            DB::raw('requisition_training_cost_favourites.created_at AS created_at'),
            DB::raw('requisition_training_cost_favourites.uuid AS uuid'),
        ])
            ->join('users','users.id', 'requisition_training_cost_favourites.user_id')
            ->join('requisitions', 'requisitions.id', 'requisition_training_cost_favourites.requisition_id');
    }
    public function getAllTrainingCostByRequisition($requisition_id)
    {
        return $this->getQuery()
            ->join('requisition_training_costs', 'requisition_training_costs.requisition_id', 'requisitions.id')
            ->where('requisition_training_costs.requisition_id', $requisition_id);
    }
    public function getAccessFavourites()
    {
        return $this->getQuery()
            ->where('requisition_training_cost_favourites.user_id', access()->user()->id);
    }

    public function getAccessFavoritesForPluck()
    {
        return $this->getAccessFavourites()->get()->pluck('name', 'id');
    }

    public function inputProcess($inputs)
    {
        return [
            'user_id'=>access()->user()->id,
            'requisition_id'=>$inputs['requisition_id'],
            'name'=>$inputs['name']
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $this->query()->create($this->inputProcess($inputs));
        });

    }

}
