<?php

namespace App\Repositories\Hotspot;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('hotspots.id AS id'),
            DB::raw('hotspots.creator_type AS creator_type'),
            DB::raw('hotspots.creator_id AS creator_id'),
            DB::raw('hotspots.requisition_id AS requisition_id'),
            DB::raw('hotspots.is_done AS is_done'),
            DB::raw('hotspots.status AS status'),
            DB::raw('hotspots.district_id AS district_id'),
            DB::raw('hotspots.report_id AS report_id'),
            DB::raw('hotspots.total_participant AS total_participant'),
            DB::raw('hotspots.camp AS camp'),
            DB::raw('hotspots.checkin_time AS checkin_time'),
            DB::raw('hotspots.checkout_time AS checkout_time'),
            DB::raw('hotspots.uuid AS uuid'),
            DB::raw('hotspots.created_at AS created_at')
            ])
            ->join('requisitions', 'requisitions.id', 'hotspots.requisition_id')
            ->leftjoin('reports', 'reports.id', 'hotspots.report_id');
    }
    public function getHotspotByRequisition($requisition_id)
    {
        return $this->getQuery()
            ->where('hotspots.requisition_id', $requisition_id);
    }


}
