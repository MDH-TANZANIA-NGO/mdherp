<?php

namespace App\Repositories\SupplyChain;

use App\Models\SupplyChain\stock_unit;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class stockUnitRepository extends  BaseRepository
{

    const MODEL = stock_unit::class;
//    public function __construct()
//    {
//        //
//    }
    public function Stockall()
    {
        return $this->query()->select([
//            DB::raw('stock_units.id AS id'),
            DB::raw('stock_units.title AS title'),
            DB::raw('stock_units.abbreviation AS abbreviation'),

        ]);


    }
    }

