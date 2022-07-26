<?php

namespace App\Repositories\Hotspot;

use App\Repositories\BaseRepository;

class HotspotRepository extends BaseRepository
{
    public function __construct()
    {
        //
    }
    public function store($input)
    {
        return DB::transaction(function () use ($input) {
            return access()->user()->hotspots()->create([
                'camp' => $input['camp'],
                'checkin_latitude' => isset($input['checkin_latitude']) ? $input['checkin_latitude'] : NULL,
                'checkin_longitude' => isset($input['checkin_longitude']) ? $input['checkin_longitude'] : NULL,
                'checkin_location' => isset($input['checkin_location']) ? $input['checkin_location'] : NULL,
                'checkin_time' => $input['checkin_time'],
                'checkout_time' => $input['checkout_time'],
                'creator_id' => $input['creator_id'],
                'creator_type' => $input['creator_type'],
                'requisition_id' => $input['requisition_id'],
                'checkout_latitude' => isset($input['checkout_latitude']) ? $input['checkout_latitude'] : NULL,
                'checkout_longitude' => isset($input['checkout_longitude']) ? $input['checkout_longitude'] : NULL,
                'checkout_location' => isset($input['checkout_location']) ? $input['checkout_location'] : NULL,
                'district_id' => $input['district_id'],
                'is_done' => 1,
                'status' => 1,
            ]);
        });

    }


    /**
     * @param $input
     * @return object
     */
    public function returnStore($input)
    {
        $hotspot = $this->store($input);
        return (object) [
            'code' => 201, //not found
            'status' => "ok",
            'message' => "Umefanikiwa kutoka",
            'data' => [
                'hotspot' => $hotspot
            ]
        ];
    }
}
