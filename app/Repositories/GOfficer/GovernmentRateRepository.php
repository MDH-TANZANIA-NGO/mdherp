<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GovernmentRate;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GovernmentRateRepository extends BaseRepository
{
    const MODEL = GovernmentRate::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('government_rates.id AS id'),
            DB::raw('government_rates.amount AS amount'),
            DB::raw('government_rates.created_at AS created_at'),
            DB::raw('government_rates.uuid AS uuid'),
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

    public function inputsProcessor($inputs)
    {
        return [
            'amount' => $inputs['amount'],
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }

    public function update($uuid, $inputs)
    {
        $gov_rate = $this->findByUuid($uuid);
        return DB::transaction(function () use($gov_rate, $inputs){
            return $gov_rate->update($this->inputsProcessor($inputs));
        });
    }

    public function assignRate($inputs)
    {
        return DB::transaction(function () use ($inputs){
            if(isset($inputs['scales'])){
                $rate = $this->find($inputs['rate']);
                $rate->govScales()->sync($inputs['scales']);
            }
        });
    }
}
