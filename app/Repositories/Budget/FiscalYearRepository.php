<?php

namespace App\Repositories\Budget;

use App\Models\Budget\FiscalYear;
use App\Models\Project\Activity;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class FiscalYearRepository extends BaseRepository
{
    const MODEL = FiscalYear::class;

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'title' => $inputs['title'],
            'from_at' => $inputs['from_at'],
            'to_at' => $inputs['to_at'],
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
        $fiscal_year = $this->findByUuid($uuid);
        return DB::transaction(function () use($fiscal_year, $inputs){
            return $fiscal_year->update($this->inputsProcessor($inputs));
        });
    }
}
