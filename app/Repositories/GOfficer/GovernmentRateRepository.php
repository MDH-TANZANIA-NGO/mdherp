<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GovernmentRate;
use App\Repositories\BaseRepository;

class GovernmentRateRepository extends BaseRepository
{
    const MODEL = GovernmentRate::class;
    public function __construct()
    {
        //
    }
}
