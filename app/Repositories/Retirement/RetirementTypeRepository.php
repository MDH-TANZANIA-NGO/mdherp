<?php

namespace App\Repositories\Retirement;

use App\Http\Controllers\Web\Retirement\Datatables\RetirementDatatables;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\Retirement\RetirementType;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class RetirementTypeRepository extends BaseRepository
{
    const MODEL = RetirementType::class;

    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('retirement_types.id AS id'),
            DB::raw('retirement_types.type AS type'),
        ]);
    }

    public function getTypes()
    {
        return $this->getQuery();
    }

}
