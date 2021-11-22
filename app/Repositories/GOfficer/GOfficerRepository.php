<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GOfficer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GOfficerRepository extends BaseRepository
{
    const MODEL = GOfficer::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('g_officers.id AS id'),
            DB::raw('g_officers.first_name AS first_name'),
            DB::raw('g_officers.last_name AS last_name'),
            DB::raw('g_officers.email AS email'),
            DB::raw('g_officers.phone AS phone'),
            DB::raw("CONCAT_WS(', ',g_officers.last_name, g_officers.first_name) AS names"),
            DB::raw('g_officers.uuid AS uuid'),
            DB::raw('g_scales.title AS g_scale_title'),
            DB::raw('g_rates.amount AS g_rate_amount'),
        ])
            ->leftjoin('g_scales','g_scales.id','g_officers.g_scale_id')
            ->leftjoin('g_rate_scale','g_rate_scale.g_scale_id','g_scales.id')
            ->leftjoin('g_rates','g_rates.id','g_rate_scale.g_rate_id');
    }

    public function getActive()
    {
        return $this->getQuery();
    }

    public function inputProcess($inputs)
    {
        return [
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'g_scale_id' => $inputs['g_scale'],
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($uuid, $inputs)
    {
        $g_scale = $this->findByUuid($uuid);
        return DB::transaction(function () use ($g_scale, $inputs){
            return $g_scale->update($this->inputProcess($inputs));
        });
    }

}