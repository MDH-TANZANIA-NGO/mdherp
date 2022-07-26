<?php

namespace App\Repositories\Attendance;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

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
            'latitude' => isset($input['latitude']) ? $input['latitude'] : NULL,
            'longitude' => isset($input['longitude']) ? $input['longitude'] : NULL,
            'location' => isset($input['location']) ? $input['location'] : NULL,
            'status' => 1,
            'fraud' => $fraud,
            'scale_id' => isset($input['scale_id']) ? $input['scale_id'] : null ,//default is community
            'grant_id' => isset($input['grant_id']) ? $input['grant_id'] : NULL
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
}
