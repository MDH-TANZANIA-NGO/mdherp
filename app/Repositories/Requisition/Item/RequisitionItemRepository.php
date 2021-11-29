<?php

namespace App\Repositories\Requisition\Item;

use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionItemRepository extends BaseRepository
{
    const MODEL = RequisitionItem::class;

    public function inputProcess($inputs)
    {
        return [
            'equipment_id' => $inputs['equipment_id'],
            'reason' => $inputs['reason'],
            'quantity' => $inputs['quantity'],
            'amount' => $inputs['requested_amount'],
            'total_amount' => $inputs['quantity'] * $inputs['requested_amount']
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $item = $requisition->items()->create($this->inputProcess($inputs));
            $item->districts()->sync($inputs['districts']);
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }

    public function update($uuid, $inputs)
    {
        $item = $this->findByUuid($uuid);
        return DB::transaction(function () use ($item, $inputs){
            $item->update($this->inputProcess($inputs));
            $item->districts()->sync($inputs['districts']);
            $item->requisition->updatingTotalAmount();
            return $item;
        });
    }

}
