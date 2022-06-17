<?php

namespace App\Repositories\Requisition\Equipment;

use App\Models\Requisition\Equipment\EquipmentType;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class EquipmentTypeRepository extends BaseRepository
{
    const MODEL = EquipmentType::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('equipment_types.id AS id'),
            DB::raw('equipment_types.title AS title'),
        ]);
    }

    public function getForPluck()
    {
        return $this->getQuery()->pluck('title', 'id');
    }

    public function inputProcessor($inputs)
    {
        return [
            'title' => $inputs['title'],
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcessor($inputs));
        });
    }

    public function update($uuid, $inputs)
    {
        $equipment_type = $this->findByUuid($uuid);
        return DB::transaction(function () use ($equipment_type, $inputs){
            return $equipment_type->update($this->inputProcessor($inputs));
        });
    }

}
