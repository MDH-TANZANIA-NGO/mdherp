<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance\Hotspot;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityAttendanceRepository extends  BaseRepository
{
    public function __construct()
    {
        //
    }

    public function store($input)
    {
        if ($this->checkIfHasParticipatedOnOtherHotspotToday($input)) {
            return  $this->storeParticipation($input, 1);
        }

        //TODO checkin night

        if  ($this->checkIfHasInitiatedToday($input)) {
            return $this->storeParticipation($input);
        }

    }
    public function returnStore($input)
    {
        $attendance = $this->store($input);
        return (object)[
            'code' => 200,
            'status' => true,
            'message' => 'Umefanikiwa kutoka',
            'data' => [
                'success_attendance' => $attendance,
            ],
        ];
    }
    public function checkIfHasParticipatedOnOtherHotspotToday($input)
    {
        $return = false;
        $date = Carbon::create($input['checkin_time'])->format('Y-m-d');
        $query = $this->query()
            ->where('creator_id', $input['creator_id'])
            ->where('creator_type', $input['creator_type'])
            ->whereDate('checkin_time', $date);
        if  ($query->count() > 0){
            if($query->first()->checkin_time == $input['checkin_time']){
                $return =  false;
            }else{
                $return = true;
            }
        }
        return $return;
    }
    public function storeParticipation($input, $fraud = 0)
    {
        return $this->query()->create([
            'hotspot_id' => $input['hotspot_id'],
            'creator_id' => $input['creator_id'],
            'creator_type' => $input['creator_type'],
            'checkin_time' => $input['checkin_time'],
            'checkout_time' => $input['checkout_time'],
            'mobile' => $input['mobile'],
            'offline_id' => $input['offline_id'],
            'checkin_latitude' => isset($input['checkin_latitude']) ? $input['checkin_latitude'] : NULL,
            'checkin_longitude' => isset($input['checkin_longitude']) ? $input['checkin_longitude'] : NULL,
            'checkout_latitude' => isset($input['checkout_latitude']) ? $input['checkout_latitude'] : NULL,
            'checkout_longitude' => isset($input['checkout_longitude']) ? $input['checkout_longitude'] : NULL,
            'checkin_location' => isset($input['checkin_location']) ? $input['checkin_location'] : NULL,
            'checkout_location' => isset($input['checkout_location']) ? $input['checkout_location'] : NULL,
            'status' => 1,
            'fraud' => $fraud,
            'g_scale_id' => isset($input['g_scale_id']) ? $input['g_scale_id'] : null ,//default is community
            'government_scale_id' => isset($input['government_scale_id']) ? $input['government_scale_id'] : NULL
        ]);
    }
    public function checkIfHasInitiatedToday($input)
    {
        $return = true;
        $date = Carbon::create($input['checkin_time'])->format('Y-m-d');
        $query = $this->query()
            ->where('creator_id', $input['creator_id'])
            ->where('creator_type', $input['creator_type'])
            ->where('hotspot_id', $input['hotspot_id'])
            ->whereDate('checkin_time', $date);
        if  ($query->count() > 0){
            $return = false;
        }
        return $return;
    }

    public function updateManyHotspotsOnReportRefresh($hotspots)
    {
        foreach ($hotspots as $hotspot){
            $this->setUnitIdToEachAttendee($hotspot->id);
        }
        return true;
    }
    public function setUnitIdToEachAttendee($hotspot_id)
    {
        return DB::transaction(function () use ($hotspot_id) {
            //fetch all attendances
            $attendances = $this->query()->where('hotspot_id', $hotspot_id)->get();
            foreach ($attendances as $attendance){
                //get each attendee, checkin_time and checkout_time
                switch ($attendance->creator_type) {
                    case 'App\Model\Auth\User':
                        $attendee = $attendance->creator_id;
                        $attendance->designation_id = $attendee->designation_id;
                        $attendance->save();
                        break;
                    case 'App\Model\GOfficer\GOfficer':
                        $attendee = $attendance->creator_id;
                        $attendance->designation_id = $attendee->designation_id;
                        $attendance->save();
                        break;
                }

                //update each attendee unit_id

                //save attendance with amount

            }
            return $attendances;
        });
    }

    public function allByHotspot( $hotspot_id)
    {
        return $this->getQueryOnlyAttendance()->where('hotspots.id', $hotspot_id);
    }
    public function getQueryOnlyAttendance()
    {
        return $this->query()->select([
            DB::raw('activity_attendances.id AS id'),
            DB::raw('hotspots.id AS hotspot_id'),
            DB::raw('hotspots.camp AS camp'),
            DB::raw('g_officers.id AS g_officer_id'),
            DB::raw("concat_ws(' ',g_officers.first_name,g_officers.last_name) AS full_name"),
            DB::raw("concat_ws(' ',users.first_name,users.last_name) AS staff_name"),
            DB::raw('activity_attendances.checkin_time AS checkin_time'),
            DB::raw('activity_attendances.checkout_time AS checkout_time'),
            DB::raw('activity_attendances.checkin_latitude AS checkin_latitude'),
            DB::raw('activity_attendances.checkin_longitude AS checkin_longitude'),
            DB::raw('activity_attendances.checkin_location AS checkin_location'),
            DB::raw('activity_attendances.checkout_latitude AS checkout_latitude'),
            DB::raw('activity_attendances.checkout_longitude AS checkout_longitude'),
            DB::raw('activity_attendances.checkout_location AS checkout_location'),
            DB::raw('activity_attendances.created_at AS created_at'),
            DB::raw('activity_attendances.updated_at AS updated_at'),
            DB::raw('activity_attendances.uuid AS uuid'),
            DB::raw('activity_attendances.amount_requested AS amount_requested'),
            DB::raw('activity_attendances.amount_paid AS amount_paid'),
            DB::raw('activity_attendances.status AS status'),
            DB::raw('activity_attendances.mobile AS mobile'),
            DB::raw('hotspots.creator_id AS creator_id'),
            DB::raw('districts.name AS district_name'),
            DB::raw('units.name AS unit'),
        ])
            ->join('hotspots', 'hotspots.id', 'activity_attendances.hotspot_id')
            ->leftjoin('g_officers', 'g_officers.id', 'activity_attendances.creator_id')
            ->leftjoin('users', 'users.id', 'activity_attendances.creator_id');
    }
    public function getGOfficerAttendances()
    {
        return $this->getQueryOnlyAttendance()
            ->where('activity_attendances.creator_type', 'App\Model\GOfficer');
    }
    public function getStaffAttendances()
    {
        return $this->getQueryOnlyAttendance()
            ->where('activity_attendances.creator_type', 'App\Model\User');
    }
    public function getGOfficerAttendancesById($g_officer_id)
    {
        return $this->getGOfficerAttendances()
            ->where('activity_attendances.creator_id', $g_officer_id);
    }

}
