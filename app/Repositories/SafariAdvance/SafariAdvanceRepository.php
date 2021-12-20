<?php

namespace App\Repositories\SafariAdvance;

use App\Repositories\BaseRepository;

class SafariAdvanceRepository extends BaseRepository
{
    public function __construct()
    {
        //
    }
    public function inputProcess($input)
    {
        return[
            'requisition_number' => $input['requisition_number']
        ];
    }
    public function store()
    {

    }
}
