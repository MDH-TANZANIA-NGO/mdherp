<?php

namespace App\Repositories\Budget;

use App\Models\Budget\SubBudget;
use  App\Repositories\BaseRepository;

class SubBudgetRepository extends BaseRepository
{
    const MODEL = SubBudget::class;

    public function all()
    {
        return parent::all(); // TODO: Change the autogenerated stub
    }
}