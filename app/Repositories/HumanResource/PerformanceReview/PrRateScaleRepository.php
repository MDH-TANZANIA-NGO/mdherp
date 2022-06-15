<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrRateScale;
use App\Repositories\BaseRepository;

class PrRateScaleRepository extends BaseRepository
{
    const MODEL = PrRateScale::class;

    public function forSelect()
    {
        return $this->query()->pluck('description', 'id');
    }
}
