<?php

namespace App\Repositories\Rate;

use App\Repositories\BaseRepository;
use App\Models\Rate\Rate;
use Illuminate\Support\Facades\DB;
use App\Services\Generator\Number;

class RateRepository extends BaseRepository
{
    const MODEL = Rate::class;

    /**
     * Store new resource
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create([
                'user_id' => access()->id(),
                'amount' => $inputs['amount']
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
