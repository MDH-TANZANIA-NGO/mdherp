<?php

namespace App\Repositories\Hotel;

use App\Models\Hotel\Hotel;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HotelRepository extends BaseRepository
{
    const MODEL = Hotel::class;

    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('hotels.id AS id'),
            DB::raw('hotels.name AS name'),
            DB::raw('hotels.district_id AS district_id'),
            DB::raw('hotels.remarks AS remarks'),
            DB::raw('hotels.uuid AS uuid'),
            DB::raw('districts.name AS district_name'),
            DB::raw('regions.name AS region_name'),
        ])
            ->join('districts','districts.id', 'hotels.district_id')
            ->join('regions','regions.id', 'districts.region_id');
    }
    public function getSelectedHotelForActivity($program_activity)
    {
      return  $this->getQuery()
          ->addSelect('program_activity_hotels.priority_level')
            ->join('program_activity_hotels', 'program_activity_hotels.hotel_id', 'hotels.id')
            ->join('program_activities', 'program_activities.id', 'program_activity_hotels.program_activity_id')
        ->where('program_activity_hotels.program_activity_id', $program_activity);
    }
    public function inputProcess($inputs)
    {
        return [
            'name'=>$inputs['name'],
            'district_id'=>$inputs['district_id'],
            'remarks'=>$inputs['remarks']
        ];
    }
    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->inputProcess($inputs));
        });
    }

    public function getHotelByDistrict($district)
    {
        return $this->getQuery()
            ->where('district_id', $district)
            ->get();
    }
    public function getHotelByRegion($region)
    {
        return $this->getQuery()
            ->where('regions.id', $region);
    }

    public function getSelectedHotelForSafari($safari_id)
    {
        return $this->getQuery()
            ->select([
                DB::raw('safari_advance_hotel_selections.priority_level AS priority_level'),
                DB::raw('safari_advance_hotel_selections.reserved AS reserved'),
                DB::raw('hotels.id AS id'),
                DB::raw('hotels.name AS name'),
                DB::raw('hotels.district_id AS district_id'),
                DB::raw('hotels.remarks AS remarks'),
                DB::raw('safari_advance_hotel_selections.uuid AS uuid'),
                DB::raw('districts.name AS district_name'),
                DB::raw('regions.name AS region_name'),
            ])
            ->leftjoin('safari_advance_hotel_selections', 'safari_advance_hotel_selections.hotel_id','hotels.id')
            ->where('safari_advance_hotel_selections.safari_advance_id', $safari_id)
            ->get();
    }
}
