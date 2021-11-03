<?php

namespace App\Models\Requisition;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Requisition extends BaseModel
{
    const PROCUREMENT_WORKFLOW = 1;
    const DIRECT_EXPENSE = 2;

    protected $casts = [
        'type' => 'integer'
        ];

    protected $guarded = [];
}
