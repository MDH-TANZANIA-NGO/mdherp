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
            ->leftjoin('districts','districts.id', 'hotels.district_id')
            ->leftjoin('safari_advance_hotel_selections', 'safari_advance_hotel_selections.hotel_id', 'hotels.id')
            ->leftjoin('program_activity_hotels','program_activity_hotels.hotel_id', 'hotels.id')
            ->leftjoin('regions','regions.id', 'districts.region_id');
    }
    public function getSelectedHotelForActivity($program_activity)
    {
      return  $this->getQuery()
          ->addSelect('program_activity_hotels.priority_level')
            ->join('program_activity_hotels', 'program_activity_hotels.hotel_id', 'hotels.id')
            ->join('program_activities', 'program_activities.id', 'program_activity_hotels.program_activity_id')
        ->where('program_activity_hotels.program_activity_id', $program_activity);
    }
    public function getAllApprovedActivityHotels()
    {
        return  $this->getQuery()
        ->addSelect([
            DB::raw('program_activity_hotels.reserved AS reserved'),
            DB::raw('program_activity_hotels.uuid AS uuid'),
            DB::raw('program_activities.uuid AS activity_uuid'),
            DB::raw('program_activities.id AS activity_id'),
            DB::raw('program_activities.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as requester"),
            DB::raw('program_activities.number AS safari_number'),
            DB::raw('requisition_trainings.start_date AS start_date'),])

//        ->join('program_activity_hotels', 'program_activity_hotels.hotel_id', 'hotels.id')
        ->join('program_activities', 'program_activities.id', 'program_activity_hotels.program_activity_id')
            ->leftjoin('requisition_trainings','requisition_trainings.id', 'program_activities.requisition_training_id')
            ->leftjoin('users','users.id', 'program_activities.user_id')
            ->where('program_activities.wf_done', 1);
    }
    public function getAllActivityUnbookedHotels()
    {
        return $this->getAllApprovedActivityHotels()
            ->where('program_activity_hotels.reserved', false)
            ->whereDate('requisition_trainings.start_date', '>=', today())
            ->groupBy('program_activities.id','hotels.id','districts.name','regions.name','program_activity_hotels.reserved','program_activity_hotels.uuid','users.first_name', 'users.last_name','requisition_trainings.start_date');
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
    public function getHotelForPluck()
    {
        return $this->getQuery()->pluck('name', 'id');
    }

    public function getSelectedHotelForSafari($safari_id)
    {
        return $this->getQuery()
            ->select([
//                DB::raw('safari_advance_hotel_selections.priority_level AS priority_level'),
                DB::raw('safari_advance_hotel_selections.reserved AS reserved'),
                DB::raw('hotels.id AS id'),
                DB::raw('hotels.name AS name'),
                DB::raw('hotels.district_id AS district_id'),
                DB::raw('hotels.remarks AS remarks'),
                DB::raw('safari_advance_hotel_selections.uuid AS uuid'),
                DB::raw('districts.name AS district_name'),
                DB::raw('regions.name AS region_name'),
            ])
//            ->leftjoin('safari_advance_hotel_selections', 'safari_advance_hotel_selections.hotel_id','hotels.id')
            ->where('safari_advance_hotel_selections.safari_advance_id', $safari_id)
            ->groupBy('safari_advance_hotel_selections.safari_advance_id','safari_advance_hotel_selections.reserved','hotels.id','safari_advance_hotel_selections.uuid','districts.name','regions.name')
            ->get();
    }

    public function getAllApprovedSafariBookingHotels()
    {

       return  $this->getQuery()
        ->addSelect([
//        DB::raw('safari_advance_hotel_selections.id AS hotel_reservation_id'),
        DB::raw('safari_advance_hotel_selections.reserved AS reserved'),
        DB::raw('safari_advance_hotel_selections.uuid AS uuid'),
            DB::raw('safari_advances.uuid AS safari_uuid'),
            DB::raw('safari_advances.id AS safari_id'),
            DB::raw('safari_advances.user_id AS user_id'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as requester"),
            DB::raw('safari_advances.number AS safari_number'),
            DB::raw('requisition_travelling_costs.from AS start_date'),
    ])
        ->leftjoin('safari_advances','safari_advance_hotel_selections.safari_advance_id', 'safari_advances.id')
           ->leftjoin('requisition_travelling_costs','requisition_travelling_costs.id', 'safari_advances.requisition_travelling_cost_id')
           ->leftjoin('users','users.id', 'safari_advances.user_id')
        ->where('safari_advances.wf_done', 1);
    }
    public function getAllSafariBookedHotels()
    {
       return $this->getAllApprovedSafariBookingHotels()
       ->where('safari_advance_hotel_selections.reserved', true);
    }
    public function getAllSafariUnbookedHotels()
    {
        return $this->getAllApprovedSafariBookingHotels()
            ->where('safari_advance_hotel_selections.reserved', false)
            ->whereDate('requisition_travelling_costs.from', '>=', today())
            ->groupBy('safari_advances.id','hotels.id','districts.name','regions.name','safari_advance_hotel_selections.reserved','safari_advance_hotel_selections.uuid','users.first_name', 'users.last_name','requisition_travelling_costs.from');
    }

}
