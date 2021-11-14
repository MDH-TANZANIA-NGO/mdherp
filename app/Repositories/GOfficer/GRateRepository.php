<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GRate;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GRateRepository extends BaseRepository
{
    const MODEL = GRate::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('g_rates.id AS id'),
            DB::raw('g_rates.amount AS amount'),
            DB::raw('g_rates.created_at AS created_at'),
            DB::raw('g_rates.uuid AS uuid'),
        ]);
    }

    public function getActive()
    {
        return $this->getQuery();
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

    /**
     * Store new Activity
     * @param $uuid
     * @param $inputs
     * @return mixed
     */
    public function update($uuid, $inputs)
    {
        $g_rate = $this->findByUuid($uuid);
        return DB::transaction(function () use($g_rate, $inputs){
            return $g_rate->update($this->inputsProcessor($inputs));
        });
    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function assignRate($inputs)
    {
        return DB::transaction(function () use ($inputs){
            if(isset($inputs['scales'])){
                $rate = $this->find($inputs['rate']);
                $rate->scales()->sync($inputs['scales']);
            }
        });
    }

}
