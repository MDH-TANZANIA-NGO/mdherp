<?php

namespace App\Repositories\MdhRates;

use App\Models\MdhRates\mdh_rate;
use App\Models\System\Region;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class mdhRatesRepository extends BaseRepository
{
   const MODEL = mdh_rate::class;

    public function getQueryRates()
    {
        return $this->query()->select([
            DB::raw('mdh_rates.id AS id'),
            DB::raw('mdh_rates.amount AS amount'),
            DB::raw('mdh_rates.created_at AS created_at'),
            DB::raw('mdh_rates.uuid AS uuid'),
        ]);
    }

    public function getActive()
    {
        return $this->getQueryRates();
    }

    public function getNotAssignedRegionRate()
    {
        return $this->getQueryRates()
            ->whereDoesntHave('regions');
    }
    public function getRateIDByRegion($region_id)
    {
        return $this->getQueryRates()
            ->leftjoin('mdh_rate_regions', 'mdh_rate_regions.mdh_rate_id', 'mdh_rates.id')
            ->where('mdh_rate_regions.region_id', $region_id)
            ->get()
            ->pluck('id');
    }
    public function getRateByRegion($region_id)
    {
        return $this->getQueryRates()
            ->leftjoin('mdh_rate_regions', 'mdh_rate_regions.mdh_rate_id', 'mdh_rates.id')
            ->where('mdh_rate_regions.region_id', $region_id)
            ->get()
            ->pluck('amount');
    }

    public function getForPluck()
    {
        return $this->getActive()->pluck('amount','id');
    }

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'amount' => $inputs['amount'],
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

    public function assignRate($inputs)
    {
        return DB::transaction(function () use ($inputs){
            if(isset($inputs['scales'])){
                $rate = $this->find($inputs['rate']);
                $rate->regions()->sync($inputs['scales']);
            }
        });
    }

}
