<?php

namespace App\Repositories\RetentionRepository;

use App\Repositories\BaseRepository;
use App\Models\MDHData\Retention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RetentionRepository extends BaseRepository
{

    const MODEL = Retention::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('retentions.id AS id'),
            DB::raw('retentions.form_date AS form_date'),
            DB::raw('retentions.data_clerk_id AS data_clerk_id'),
            DB::raw('retentions.facility_id AS facility_id'),
            DB::raw('retentions.tracked AS tracked'),
            DB::raw('retentions.returned AS returned'),
            DB::raw('retentions.regularly_attending AS regularly_attending'),
            DB::raw('retentions.confirmed_transfer_out AS confirmed_transfer_out'),
            DB::raw('retentions.not_confirmed_transfer_out AS not_confirmed_transfer_out'),
            DB::raw('retentions.opted_out AS opted_out'),
            DB::raw('retentions.death AS death'),
            DB::raw('retentions.ltfu AS ltfu'),
            DB::raw('retentions.promise_to_come AS promise_to_come'),
            DB::raw('retentions.wrong_incomp_no_mapcue AS wrong_incomp_no_mapcue'),
            DB::raw('retentions.phone_not_reachable AS phone_not_reachable'),
            DB::raw('retentions.unanswered_call AS unanswered_call'),
            DB::raw('retentions.not_hiv_positive_client AS not_hiv_positive_client'),
            DB::raw('retentions.invalid_id AS invalid_id'),
            DB::raw('retentions.attended_other_clinic AS attended_other_clinic'),
            DB::raw('retentions.comments AS comments'),
            DB::raw('retentions.latitude AS latitude'),
            DB::raw('retentions.longitude AS longitude'),
            DB::raw('retentions.location AS location'),
            DB::raw('retentions.form_date_time AS form_date_time'),
        ]);
    }

    public function inputProcess($inputs)
    {
//        $description = $inputs['description'];
        return [
            'form_date' => $inputs['form_date'],
            'data_clerk_id' => $inputs['data_clerk_id'],
            'facility_id' => $inputs['facility_id'],
            'tracked' => $inputs['tracked'],
            'returned' => $inputs['returned'],
            'regularly_attending' => $inputs['regularly_attending'],
            'confirmed_transfer_out' => $inputs['confirmed_transfer_out'],
            'not_confirmed_transfer_out' => $inputs['not_confirmed_transfer_out'],
            'opted_out' => $inputs['opted_out'],
            'death' => $inputs['death'],
            'ltfu' => $inputs['ltfu'],
            'promise_to_come' => $inputs['promise_to_come'],
            'wrong_incomp_no_mapcue' => $inputs['wrong_incomp_no_mapcue'],
            'phone_not_reachable' => $inputs['phone_not_reachable'],
            'unanswered_call' => $inputs['unanswered_call'],
            'wrong_phone_number' => $inputs['wrong_phone_number'],
            'not_hiv_positive_client' => $inputs['not_hiv_positive_client'],
            'invalid_id' => $inputs['invalid_id'],
            'attended_other_clinic' => $inputs['attended_other_clinic'],
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
            $retention =  $this->query()->create($inputs);
             
            return $retention;

        });
    }

    public function getGOfficerRetentions($g_officer, $facility){
        return $this->getQuery()
            ->where('retentions.data_clerk_id', $g_officer)
            ->where('retentions.facility_id', $facility)
            ->orderBy('retentions.form_date', 'DESC');
    }

    public function filterReportsByDate($inputs)
    {
        $from = $inputs['from'];
        $to = $inputs['to'];
        $g_officer = $inputs['data_clerk_id'];
        $facility = $inputs['facility_id'];

        return $this->getQuery()
            ->where('retentions.data_clerk_id', '=', $g_officer)
            ->where('retentions.facility_id', '=', $facility)
            ->whereBetween('retentions.form_date', [$from, $to])
            ->orderBy('retentions.form_date', 'DESC');
    
    }

}