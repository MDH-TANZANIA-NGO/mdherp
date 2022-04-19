<?php

namespace App\Repositories\Facilities;

use App\Models\Facility\Facility;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class FacilitiesRepository extends BaseRepository
{
    const MODEL =  Facility::class;
    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('facilities.id AS id'),
            DB::raw('facilities.number AS number'),
            DB::raw("CONCAT_WS(', ',facilities.name, facilities.number) AS unique"),
            DB::raw('facilities.name AS name'),

        ]);

    }

    public function getForPLuck()
    {
        return $this->getQuery()->pluck('unique', 'id');
    }
    public function getGofficerFacility($user_id)
    {
        return $this->query()->select([
            'facilities.id AS id',
            'facilities.name AS name'
        ])
            ->leftjoin('facility_g_officer','facility_g_officer.facility_id','facilities.id')
            ->leftjoin('g_officers','g_officers.id','facility_g_officer.g_officer_id')
            ->where('g_officers.id', $user_id)
            ->get();
    }
}
