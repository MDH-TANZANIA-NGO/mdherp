<?php

namespace App\Repositories\Timesheet;

use App\Models\Attendance\Attendance;
use App\Models\Timesheet\Timesheet;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TimesheetRepository extends BaseRepository
{
    const MODEL = Timesheet::class;
    public function __contruct(){

    }

    public function getQuery(){
        return $this->query()->select([
            DB::raw('timesheets.id AS id'),
            DB::raw('timesheets.uuid AS uuid'),
            DB::raw('timesheets.user_id AS user_id'),
            DB::raw('timesheets.hrs AS hours'),
            DB::raw('timesheets.wf_done_date AS wf_done_date'),
            DB::raw('users.identity_number AS identity_number'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as fullName"),
            DB::raw('timesheets.created_at AS created_at'),
        ])
            ->join('users','users.id', 'timesheets.user_id');
    }

    public function getAllApprovedTimesheets()
    {
        return $this->getQuery()
            ->where('timesheets.wf_done', true);
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done_date', null)
            ->where('timesheets.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', 0)
            ->where('timesheets.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', true)
            ->where('timesheets.rejected', false)
            ->where('users.id', access()->id());
    }

    public function getSubmittedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done_date', null)
            ->where('timesheets.rejected', false);
    }

    public function getApprovedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', true)
            ->where('timesheets.rejected', false);
    }

    public function getRejectedTimesheets(){
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('timesheets.wf_done', 0)
            ->where('timesheets.rejected', true);
    }

}
