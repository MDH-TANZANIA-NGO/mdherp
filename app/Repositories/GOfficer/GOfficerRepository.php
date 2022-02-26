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
            DB::raw('g_officers.g_scale_id as g_scale_id'),
            DB::raw('g_scales.title AS g_scale_title'),
            DB::raw('g_rates.amount AS g_rate_amount'),
            DB::raw('g_officers.region_id AS region_id'),
            DB::raw('regions.name AS region_name'),
            DB::raw('g_officers.district_id as district_id'),
            DB::raw('districts.name as district'),
            DB::raw('g_officers.isactive as isactive'),
            DB::raw('g_officers.fingerprint_data as fingerprint_data'),
            DB::raw('g_officers.fingerprint_length as fingerprint_length')
        ])
            ->leftjoin('g_scales','g_scales.id','g_officers.g_scale_id')
            ->leftjoin('g_rate_scale','g_rate_scale.g_scale_id','g_scales.id')
            ->leftjoin('g_rates','g_rates.id','g_rate_scale.g_rate_id')
            ->leftjoin('regions', 'regions.id', 'g_officers.region_id')
            ->leftjoin('districts', 'districts.id', 'g_officers.district_id');
    }

    public function getActive()
    {
        return $this->getQuery();
    }
    public function getNotSelectedInActivity()
    {
        return $this->getQuery()
            ->whereHas('Training');
    }

    public function inputProcess($inputs)
    {
        return [
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'g_scale_id' => $inputs['g_scale'],
            'region_id' => $inputs['region_id'],
//            'district_id' => $inputs['district_id'],
            'country_organisation_id' => 1,
            'isactive' => 1,
//            'fingerprint_data' => $inputs['fingerprint_data'],
//            'fingerprint_length' => $inputs['fingerprint_length'],
//            'password' => bcrypt(strtolower($inputs['last_name'])),
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
