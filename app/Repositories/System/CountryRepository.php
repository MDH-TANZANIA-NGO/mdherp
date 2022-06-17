<?php

namespace App\Repositories\System;

use App\Models\System\Country;
use App\Repositories\BaseRepository;

class CountryRepository extends BaseRepository
{
    const MODEL = Country::class;

    public function getCountryByCode($code)
    {
        return $this->query()->where('code', $code)->first();
    }
}