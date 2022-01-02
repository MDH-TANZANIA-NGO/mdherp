<?php

namespace App\Repositories\Requisition\Training;

use App\Models\BaseModel;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_item;
use Illuminate\Support\Facades\DB;

class RequisitionTrainingItemsRepository extends BaseModel
{
   const MODEL = requisition_training_item::class;
    public function __construct()
    {
        //
    }
    public function trainingItems()
    {
        return $this->query()->select([
            DB::raw('requisition_training_items.id AS id'),
            DB::raw('requisition_training_items.requisition_id AS requisition_id'),
            DB::raw('requisition_training_items.title AS title'),
            DB::raw('requisition_training_items.unit AS unit'),
            DB::raw('requisition_training_items.unit_price AS unit_price'),
            DB::raw('requisition_training_items.total_amount AS total_amount'),
            DB::raw('requisitions.id AS requisition_ID'),




        ])->join('requisitions','requisitions.id','requisition_training_items.requisition_id');

    }
    public function inputProcess($input)
    {

        return [
//            'requisition_id' => $input['requisition_id'],
        'requisition_training_id' => $input['requisition_training_id'],
            'title' => $input['title'],
            'unit' => $input['unit'],
            'unit_price' => $input['unit_price'],
            'total_amount' => $input['unit'] * $input['unit_price']
        ];
    }
    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $requisition->trainingItems()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }
}
