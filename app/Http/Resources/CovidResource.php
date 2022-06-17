<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CovidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'form_date' => $this->form_date,
            'data_clerk_id' => $this->data_clerk_id,
            'facility_id' => $this->facility_id,
            'attended' => $this->attended,
            'already_vaccinated' => $this->already_vaccinated,
            'vaccine_eligible' => $this->vaccine_eligible,
            'vaccinated' => $this->vaccinated,
            'vaccinated_community_art' => $this->vaccinated_community_art,
            'vaccinated_konga' => $this->vaccinated_konga,
            'vaccinated_home_based' => $this->vaccinated_home_based,
            'vaccinated_routine_fcd' => $this->vaccinated_routine_fcd,
            'vaccinated_cbs' => $this->vaccinated_cbs,
            'vaccinated_others' => $this->vaccinated_others,
            'JJ_used' => $this->JJ_used,
            'MD_used' => $this->MD_used,
            'PF_used' => $this->PF_used,
            'SN_used' => $this->SN_used,
            'JJ_expired' => $this->JJ_expired,
            'MD_expired' => $this->MD_expired,
            'PF_expired' => $this->PF_expired,
            'SN_expired' => $this->SN_expired,
            'JJ_available' => $this->JJ_available,
            'MD_available' => $this->MD_available,
            'PF_available' => $this->PF_available,
            'SN_available' => $this->SN_available,
            'comments' => $this->comments,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location' => $this->location,
            'form_date_time' => $this->form_date_time,
            'status' => $this->status,
        ];
    }
}
