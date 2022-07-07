<?php

namespace App\Http\Controllers\Web\InductionSchedule\Traits;

use App\Models\InductionSchedule\InductionSchedule;
use App\Models\InductionSchedule\InductionScheduleParticipant;
use App\Models\Unit\Designation;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

trait InductionScheduleDatatable
{
    public function processingDatatable(){
        $data = InductionSchedule::where('status', 0)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('designation_id', function($query){
                return (Designation::where('id', $query->designation_id)->first())->fullTitle;
            })
            ->addColumn('participants', function($query) {
                $participants = InductionScheduleParticipant::where('induction_schedule_id', $query->id)->get();
                $users = [];
                foreach ($participants as $participant){
                    array_push($users, $participant->user->full_name_formatted );
                }
                return $users;
            })
            ->editColumn('start_date', function ($query) {
                return Carbon::create($query->start_date)->format('d-m-Y');
            })
            ->editColumn('end_date', function ($query) {
                return Carbon::create($query->end_date)->format('d-m-Y');
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('induction_schedule.showSchedule', $query->uuid).'" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
