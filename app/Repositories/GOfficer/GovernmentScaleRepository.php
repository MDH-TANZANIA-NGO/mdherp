<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GovernmentScale;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GovernmentScaleRepository extends BaseRepository
{
    const MODEL =  GovernmentScale::class;
    public function __construct()
    {
        //
    }

    public function getForDualList()
    {
        return $this->query()->select([
            DB::raw('government_scales.id AS id'),
            DB::raw('government_scales.title AS title'),
            DB::raw('government_scales.uuid AS uuid'),
            DB::raw('government_rates.id AS government_id'),
        ])
            ->leftjoin('government_rate_scales','government_rate_scales.government_scale_id','government_scales.id')
            ->leftjoin('government_rates','government_rates.id','government_rate_scales.government_rate_id')
            ->groupBy('government_scales.id','government_rates.id')
            ->get();
    }

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

    public function update($uuid, $inputs)
    {
        $government_scale = $this->findByUuid($uuid);
        return DB::transaction(function () use($government_scale, $inputs){
            return $government_scale->update($this->inputsProcessor($inputs));
        });
    }
}
