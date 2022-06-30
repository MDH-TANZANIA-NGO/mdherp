<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\HumanResource\StaffHiring\StaffHiring;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffHiringRepository extends BaseRepository
{
    const MODEL = StaffHiring::class;

    public function store($input)
    {
        return DB::transaction(function () use($input){
            $inset = [
                'candidate_name' => $input['candidate_name'],
                'know_period' => $input['know_period'],
                'know_capacity' => $input['know_capacity'],
                'relate' => $input['relate'],
                'rate_proffesional' => $input['rate_proffesional'],
                'rate_commitment' => $input['rate_commitment'],
                'rate_knowledge' => $input['rate_knowledge'],
                'rate_trust' => $input['rate_trust'],
                'rate_deadlines' => $input['rate_deadlines'],
                'rate_relationship_with_others' => $input['rate_relationship_with_others'],
                'general_opinion' => $input['general_opinion'],
                'ref_name' => $input['ref_name'],
                'ref_email' => $input['ref_email'],
            ];
            return $this->query()->create($inset);
        });
    }

}
