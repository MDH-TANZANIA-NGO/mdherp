<?php

namespace App\Repositories\Requisition\Equipment;

use App\Models\Requisition\Equipment\Equipment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class EquipmentRepository extends BaseRepository
{
    const MODEL = Equipment::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('equipments.id AS id'),
            DB::raw('equipments.title AS title'),
            DB::raw('equipments.price_range_from AS price_range_from'),
            DB::raw('equipments.price_range_to AS price_range_to'),
            DB::raw('equipments.specs AS specs'),
            DB::raw('equipments.uuid AS uuid'),
            DB::raw('equipment_types.title AS equipment_title'),
        ])
            ->join('equipment_types','equipment_types.id','equipments.equipment_type_id');
    }

    public function getForDatatables()
    {
        return $this->getQuery();
    }

    public function getById($inputs)
    {
        return $this->getQuery()->where('equipments.id', $inputs['equipment_id'])->first();
    }

    public function inputsProcessor($inputs)
    {
        return [
            'equipment_type_id' => $inputs['equipment_type'],
            'title' => $inputs['title'],
            'specs' => $inputs['specs'],
            'price_range_from' => $inputs['price_from'],
            'price_range_to' => $inputs['price_to'],
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }

    public function update($uuid, $inputs)
    {
        $requisition = $this->findByUuid($uuid);
        return DB::transaction(function () use ($requisition, $inputs){
            return $requisition->update($this->inputsProcessor($inputs));
        });
    }
}
