<?php

namespace App\Repositories\Project;

use App\Models\Project\Activity;
use App\Models\Project\OutputUnit;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OutputUnitRepository extends BaseRepository
{
    const MODEL = OutputUnit::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('output_units.id AS id'),
            DB::raw('output_units.title AS title'),
            DB::raw('output_units.created_at AS created_at'),
            DB::raw('output_units.uuid AS uuid'),
        ]);
    }

    public function getActive()
    {
        return $this->getQuery()
            ->where('output_units.active', true);
    }

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'title' => $inputs['title'],
        ];
    }

    /**
     * Store new Activity
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }

    /**
     * Store new Activity
     * @param Activity $activity
     * @param $inputs
     * @return mixed
     */
    public function update($uuid, $inputs)
    {
        $output_unit = $this->findByUuid($uuid);
        return DB::transaction(function () use($output_unit, $inputs){
            return $output_unit->update($this->inputsProcessor($inputs));
        });
    }
}
