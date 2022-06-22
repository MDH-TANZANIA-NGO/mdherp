<?php

namespace App\Repositories\MchRepository;

use App\Repositories\BaseRepository;
use App\Models\MDHData\Mch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MchRepository extends BaseRepository
{

    const MODEL = Mch::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('mchs.id AS id'),
            DB::raw('mchs.form_date AS form_date'),
            DB::raw('mchs.data_clerk_id AS data_clerk_id'),
            DB::raw('mchs.facility_id AS facility_id'),
            DB::raw('mchs.total_first_attendance_2ab AS total_first_attendance_2ab'),
            DB::raw('mchs.preg_known_pos_5a AS preg_known_pos_5a'),
            DB::raw('mchs.preg_1st_test_5c AS preg_1st_test_5c'),
            DB::raw('mchs.preg_1st_test_pos_5d AS preg_1st_test_pos_5d'),
            DB::raw('mchs.preg_2nd_test_5h AS preg_2nd_test_5h'),
            DB::raw('mchs.preg_2nd_test_pos_5i AS preg_2nd_test_pos_5i'),
            DB::raw('mchs.hei_registered AS hei_registered'),
            DB::raw('mchs.dbs_taken_at_12_mo AS dbs_taken_at_12_mo'),
            DB::raw('mchs.dbs_taken_below_2_mo AS dbs_taken_below_2_mo'),
            DB::raw('mchs.mtuha12_facility_delivery_2a AS mtuha12_facility_delivery_2a'),
            DB::raw('mchs.mtuha12_non_facility_delivery_2b AS mtuha12_non_facility_delivery_2b'),
            DB::raw('mchs.mtuha12_traditional_delivery_2c AS mtuha12_traditional_delivery_2c'),
            DB::raw('mchs.mtuha12_home_delivery_2d AS mtuha12_home_delivery_2d'),
            DB::raw('mchs.mtuha12_total_deliveries_2abcd AS mtuha12_total_deliveries_2abcd'),
            DB::raw('mchs.comments AS comments'),
            DB::raw('mchs.latitude AS latitude'),
            DB::raw('mchs.longitude AS longitude'),
            DB::raw('mchs.location AS location'),
            DB::raw('mchs.form_date_time AS form_date_time'),
        ]);
    }

    public function inputProcess($inputs)
    {
        return [
            'form_date' => $inputs['form_date'],
            'data_clerk_id' => $inputs['data_clerk_id'],
            'facility_id' => $inputs['facility_id'],
            'total_first_attendance_2ab' => $inputs['total_first_attendance_2ab'],
            'preg_known_pos_5a' => $inputs['preg_known_pos_5a'],
            'preg_1st_test_5c' => $inputs['preg_1st_test_5c'],
            'preg_1st_test_pos_5d' => $inputs['preg_1st_test_pos_5d'],
            'preg_2nd_test_5h' => $inputs['preg_2nd_test_5h'],
            'preg_2nd_test_pos_5i' => $inputs['preg_2nd_test_pos_5i'],
            'hei_registered' => $inputs['hei_registered'],
            'dbs_taken_at_12_mo' => $inputs['dbs_taken_at_12_mo'],
            'dbs_taken_below_2_mo' => $inputs['dbs_taken_below_2_mo'],
            'mtuha12_facility_delivery_2a' => $inputs['mtuha12_facility_delivery_2a'],
            'mtuha12_non_facility_delivery_2b' => $inputs['mtuha12_non_facility_delivery_2b'],
            'mtuha12_traditional_delivery_2c' => $inputs['mtuha12_traditional_delivery_2c'],
            'mtuha12_home_delivery_2d' => $inputs['mtuha12_home_delivery_2d'],
            'mtuha12_total_deliveries_2abcd' => $inputs['mtuha12_total_deliveries_2abcd'],
            'comments' => $inputs['comments'],
            'latitude' => $inputs['latitude'],
            'longitude' => $inputs['longitude'],
            'location' => $inputs['location'],
            'form_date_time' => $inputs['form_date_time'],
        ];
    }

    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs) {
            $mch =  $this->query()->create($inputs);
             
            return $mch;

        });
    }

    public function getGOfficerMchs($g_officer, $facility){
        return $this->getQuery()
            ->where('mchs.data_clerk_id', $g_officer)
            ->where('mchs.facility_id', $facility)
            ->orderBy('mchs.form_date', 'DESC');
    }

    public function filterReportsByDate($inputs)
    {
        $from = $inputs['from'];
        $to = $inputs['to'];
        $g_officer = $inputs['data_clerk_id'];
        $facility = $inputs['facility_id'];

        return $this->getQuery()
            ->where('mchs.data_clerk_id', '=', $g_officer)
            ->where('mchs.facility_id', '=', $facility)
            ->whereBetween('mchs.form_date', [$from, $to])
            ->orderBy('mchs.form_date', 'DESC');
    
    }

}