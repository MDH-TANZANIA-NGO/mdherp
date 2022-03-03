<?php

namespace App\Repositories\ProgramActivity;


use App\Models\ProgramActivity\ProgramActivityReport;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Illuminate\Support\Facades\DB;

class ProgramActivityReportRepository extends BaseRepository
{
    const MODEL =  ProgramActivityReport::class;
use Number;
    public function __construct()
    {
        //
    }

    public function inputProcess($inputs){

        return [

            'program_activity_id'=>$inputs['program_activity_id'],
            'region_id'=> access()->user()->region_id,
            'user_id'=>access()->user()->id,

        ];
    }

    public function processInputs($inputs){

        return [
            'venue_name'=>$inputs['venue'],
            'background_info'=>$inputs['background_info'],
            'what_was_planned'=>$inputs['plan'],
            'objectives'=>$inputs['objectives'],
            'methodology'=>$inputs['methodology'],
            'achievement'=>$inputs['achievement'],
            'challenges'=>$inputs['challenges'],
            'recommendations'=>$inputs['recommendations'],
            'status'=>$inputs['status']

        ];

    }

    public function store($inputs){
        return DB::transaction(function () use ($inputs){

            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update($inputs, $uuid){


        return DB::transaction(function () use ($inputs, $uuid){
            $program_activity_report =  $this->findByUuid($uuid);
            $number = $this->generateNumber($program_activity_report);
            $this->query()->update($this->processInputs($inputs));
            DB::update('update program_activity_reports set number = ?, done = ? where uuid=?', [$number, true, $uuid]);
        });

    }


}
