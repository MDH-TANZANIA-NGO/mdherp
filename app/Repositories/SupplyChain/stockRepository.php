<?php

namespace App\Repositories\SupplyChain;

use App\Models\SupplyChain\stock;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class stockRepository extends BaseRepository
{
    const MODEL = stock::class;
    public function __construct()
    {
        //
    }
    public function allStocks()
    {
        return $this->query()->select([
            DB::raw('stocks.title AS title'),
            DB::raw('stocks.expense_id AS expense_id'),
            DB::raw('stocks.quantity AS quantity'),
            DB::raw('stocks.date_received AS date_received'),
        ]);


    }
}
