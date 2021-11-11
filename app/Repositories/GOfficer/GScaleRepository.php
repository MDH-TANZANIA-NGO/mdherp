<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GScale;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GScaleRepository extends BaseRepository
{
    const MODEL = GScale::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('g_scales.title AS title'),
            DB::raw('g_scales.created_at AS created_at'),
            DB::raw('g_scales.uuid AS uuid'),
        ]);
    }

    public function getActive()
    {
        return $this->getQuery();
    }

    public function getForDualList()
    {
        return $this->query()->select([
            DB::raw('g_scales.id AS id'),
            DB::raw('g_scales.title AS title'),
            DB::raw('g_scales.uuid AS uuid'),
            DB::raw('g_rates.id AS g_rate_id'),
        ])
            ->leftjoin('g_rate_scale','g_rate_scale.g_scale_id','g_scales.id')
            ->leftjoin('g_rates','g_rates.id','g_rate_scale.g_rate_id')
            ->groupBy('g_scales.id','g_rates.id')
            ->get();
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
     * @param $uuid
     * @param $inputs
     * @return mixed
     */
    public function update($uuid, $inputs)
    {
        $g_scale = $this->findByUuid($uuid);
        return DB::transaction(function () use($g_scale, $inputs){
            return $g_scale->update($this->inputsProcessor($inputs));
        });
    }
}
