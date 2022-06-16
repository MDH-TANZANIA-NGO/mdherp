<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrType;
use App\Repositories\BaseRepository;

class PrTypeRepository extends BaseRepository
{
    const MODEL = PrType::class;

    public function forSelect()
    {
        return $this->query()->pluck('title','id');
    }

}
