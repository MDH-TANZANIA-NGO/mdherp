<?php

namespace App\Repositories\Requisition\RequisitionType;

use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTypeRepository extends BaseRepository
{
    const MODEL = RequisitionType::class;
}
