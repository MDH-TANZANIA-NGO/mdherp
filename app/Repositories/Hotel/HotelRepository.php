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
            ->leftjoin('safari_advance_hotel_selections', 'safari_advance_hotel_selections.hotel_id','hotels.id')
            ->get();
    }
}
