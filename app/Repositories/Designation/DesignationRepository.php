<?php

namespace App\Repositories\Designation;

use App\Models\Unit\Designation;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DesignationRepository extends BaseRepository
{
    const MODEL = Designation::class;

    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('designations.id AS id'),
            DB::raw('designations.name AS designation_name'),
            DB::raw('designations.short_name AS designation_short_name'),
            DB::raw('designations.isactive AS isactive'),
            DB::raw('designations.unit_id AS unit_id'),
        ])
            ->join('units','units.id', 'designations.unit_id');
    }
}
