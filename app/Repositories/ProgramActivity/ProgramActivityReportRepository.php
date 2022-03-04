<?php

namespace App\Repositories\ProgramActivity;


use App\Models\ProgramActivity\ProgramActivity;
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

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('program_activity_reports.id AS id'),
            DB::raw('program_activity_reports.user_id AS user_id'),
            DB::raw('program_activity_reports.number AS number'),
            DB::raw('program_activity_reports.created_at AS created_at'),
            DB::raw('program_activity_reports.uuid AS uuid'),
            DB::raw('program_activity_reports.status AS status'),
            DB::raw('program_activity_reports.region_id AS region_id'),
             DB::raw('program_activities.number AS activity_number'),
            DB::raw('program_activities.id AS activity_id')
        ])
            ->join('users','users.id', 'program_activity_reports.user_id')
            ->join('program_activities','program_activities.id','program_activity_reports.program_activity_id');
    }

    public function getOnprogressActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', false)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getSavedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', false)
            ->where('program_activity_reports.done', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getReturnedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', false)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', true)
            ->where('program_activity_reports.user_id', access()->user()->id);
    }
    public function getApprovedActivityReports(){
        return $this->getQuery()
            ->where('program_activity_reports.wf_done', true)
            ->where('program_activity_reports.done', true)
            ->where('program_activity_reports.rejected', false)
            ->where('program_activity_reports.user_id', access()->user()->id);
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
            if ($program_activity_report->done == true){

                if ($inputs['status'] == 'final'){
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                    DB::update('update program_activities set report_submitted = ? where uuid=?', [true,  $program_activity->uuid]);
                }
                else{
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                }

            }



            else{
                if ($inputs['status'] == 'final')
                {
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                    DB::update('update program_activities set report_submitted = ? where uuid=?', [true,  $program_activity->uuid]);
                    DB::update('update program_activity_reports set number = ?, done = ? where uuid=?', [$number, true, $uuid]);

                }
                else{
                    $this->findByUuid($uuid)->update($this->processInputs($inputs));
                    $program_activity = ProgramActivity::query()->where('id', $program_activity_report->program_activity_id)->first();
                      DB::update('update program_activity_reports set number = ?, done = ? where uuid=?', [$number, true, $uuid]);

                }

            }

        });

    }


}
