<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrRateScale;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrRateScaleRepository extends BaseRepository
{
    const MODEL = PrRateScale::class;

    public function forSelect()
    {
        return $this->query()->pluck('rate', 'id');
    }
}