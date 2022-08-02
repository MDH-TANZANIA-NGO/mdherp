<?php

namespace App\Repositories\Activity;

//use App\Activities\Reports\ActivityReport;
use App\Models\Activities\Reports\ActivityReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ActivityReportRepository extends BaseRepository
{
    const MODEL = ActivityReport::class;
    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('activity_reports.id AS id'),
            DB::raw('activity_reports.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as full_name"),
            DB::raw('users.email AS email'),
            DB::raw('users.phone AS phone'),
            DB::raw('activity_reports.number AS number'),
            DB::raw('activity_reports.start_date AS start_date'),
            DB::raw('activity_reports.end_date AS end_date'),
            DB::raw('requisitions.number AS requisition_number'),
            DB::raw('activity_reports.created_at AS created_at'),
            DB::raw('activity_reports.report_type AS report_type'),
            DB::raw('activity_reports.uuid AS uuid'),
            DB::raw('regions.name AS region_name'),
        ])
            ->join('users','users.id', 'activity_reports.user_id')
            ->join('requisitions','requisitions.id','activity_reports.requisition_id')
            ->join('regions','regions.id','activity_reports.region_id');
    }

    public function getAccessProcessing()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', false)
            ->where('activity_reports.wf_done', 0);
    }
    public function getAccessRejected()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', true)
            ->where('activity_reports.wf_done', 0);
    }
    public function getAccessApproved()
    {
        return $this->getQuery()
            ->where('activity_reports.done', true)
            ->where('activity_reports.user_id', access()->user()->id)
            ->where('activity_reports.rejected', false)
            ->where('activity_reports.wf_done', 1);
    }
}