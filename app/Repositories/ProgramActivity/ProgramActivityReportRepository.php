<?php

namespace App\Repositories\ProgramActivity;


use App\Models\ProgramActivity\ProgramActivityReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProgramActivityReportRepository extends BaseRepository
{
    const MODEL =  ProgramActivityReport::class;

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

    public function store($inputs){
        return DB::transaction(function () use ($inputs){

            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function update(){


    }


}
