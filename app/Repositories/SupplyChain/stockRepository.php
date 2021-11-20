<?php

namespace App\Repositories\SupplyChain;

use App\Models\SupplyChain\stock;

class stockRepository
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
            DB::raw('stocks.description AS description'),
        ]);


    }
}
