<?php

namespace App\Repositories\Requisition\Item;

use App\Exceptions\GeneralException;
use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\Requisition;
use App\Repositories\BaseRepository;
use App\Services\Calculator\Requisition\InitiatorBudgetChecker;
use Illuminate\Support\Facades\DB;

class RequisitionItemRepository extends BaseRepository
{
    use InitiatorBudgetChecker;
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
        $this->storecheck($requisition,$inputs);
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

    public function storecheck(Requisition $requisition, $inputs)
    {
        $required_amount = $inputs['requested_amount'] * $inputs['quantity'];
        $budget_summary = $this->check($requisition->requisition_type_id, $requisition->project_id, $requisition->activity_id, $requisition->region_id, null);
        $available_budget = $budget_summary['actual']-$budget_summary['pipeline'];

        if ($required_amount> $available_budget)
            throw new GeneralException('Insufficient Fund');
    }

}
