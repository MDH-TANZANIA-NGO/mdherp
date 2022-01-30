<?php

namespace App\Repositories\System;

use App\Models\System\Ward;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class WardRepository extends BaseRepository
{
    const MODEL = Ward::class;


    /**
     * create new ward
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        return DB::transaction(function () use($input) {
            $ward = $this->query()->create([
                'name' => $input['name'],
                'district_id' => $input['district_id'],
                'postcode' => $input['postcode'],
            ]);
            return $ward;
        });
    }
}
