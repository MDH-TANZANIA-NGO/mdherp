<?php

namespace App\Repositories\HumanResource\Advertisement;

use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class AdvertisementRepository extends  BaseRepository
{

    const MODEL = HireAdvertisementRequisition::class;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('hr_hire_advertisement_requisitions.title AS title'),
            DB::raw('hr_hire_advertisement_requisitions.description AS description'),
        ]);
    }

    

}
