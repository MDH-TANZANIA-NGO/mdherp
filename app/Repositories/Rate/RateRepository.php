<?php

namespace App\Repositories\Rate;

use App\Repositories\BaseRepository;
use App\Models\Rate\Rate;
use Illuminate\Support\Facades\DB;
use App\Services\Generator\Number;

class RateRepository extends BaseRepository
{
    const MODEL = Rate::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('rates.amount AS amount'),
            DB::raw('rates.active as active'),
            DB::raw('rates.created_at as created_at'),
            DB::raw('rates.uuid as uuid'),
        ]);
    }

    public function getAll()
    {
        return $this->getQuery()->orderBy('active', 'ASC');
    }

    /**
     * Store new resource
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $this->query()->update(['active' => false]);
            return $this->query()->create([
                'user_id' => access()->id(),
                'amount' => $inputs['amount'],
                'active' => true
            ]);
        });
    }

    /**
     * update existing resource
     * @param Rate $rate
     * @param $inputs
     * @return mixed
     */
    public function update(Rate $rate, $inputs)
    {
        return DB::transaction(function () use ($rate,$inputs){
            return $rate->update(['amount' => $inputs['amount']]);
        });
    }

}
