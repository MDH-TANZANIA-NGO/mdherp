<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\StaffHiring\StaffHiring;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffHiringRepository extends BaseRepository
{
    const MODEL = StaffHiring::class;

    public function store($input)
    {
        return DB::transaction(function () use($input){
            $input['candidate_name'] = 'candidate_name';

            return $this->query()->create($input);
        });
    }

}
