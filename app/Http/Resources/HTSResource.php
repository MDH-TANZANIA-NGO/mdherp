<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HTSResource extends JsonResource
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
            'tx_new_index_clients' => $this->tx_new_index_clients,
            'tx_curr_index_clients' => $this->tx_curr_index_clients,
            'hvl_index_clients' => $this->hvl_index_clients,
            'total_index_clients' => $this->total_index_clients,
            'tx_new_offered_its' => $this->tx_new_offered_its,
            'hvl_offered_its' => $this->hvl_offered_its,
            'tx_curr_offered_its' => $this->tx_curr_offered_its,
            'tx_new_accepted_its' => $this->tx_new_accepted_its,
            'hvl_accepted_its' => $this->hvl_accepted_its,
            'tx_curr_accepted_its' => $this->tx_curr_accepted_its,
            'tx_new_elicited_index_contacts' => $this->tx_new_elicited_index_contacts,
            'hvl_elicited_index_contacts' => $this->hvl_elicited_index_contacts,
            'tx_curr_elicited_index_contacts' => $this->tx_curr_elicited_index_contacts,
            'tx_new_known_positive' => $this->tx_new_known_positive,
            'hvl_known_positive' => $this->hvl_known_positive,
            'tx_curr_known_positive' => $this->tx_curr_known_positive,
            'tx_new_index_contacts_tested' => $this->tx_new_index_contacts_tested,
            'hvl_index_contacts_tested' => $this->hvl_index_contacts_tested,
            'tx_curr_index_contacts_tested' => $this->tx_curr_index_contacts_tested,
            'tx_new_index_positive' => $this->tx_new_index_positive,
            'hvl_index_positive' => $this->hvl_index_positive,
            'tx_curr_index_positive' => $this->tx_curr_index_positive,
            'tx_new_index_positive_linked' => $this->tx_new_index_positive_linked,
            'hvl_index_positive_linked' => $this->hvl_index_positive_linked,
            'tx_curr_index_positive_linked' => $this->tx_curr_index_positive_linked,
            'acceptance_rate' => $this->acceptance_rate,
            'elicitation_ratio' => $this->elicitation_ratio,
            'index_testing_rate' => $this->index_testing_rate,
            'yield' => $this->yield,
            'comments' => $this->comments,
        ];
    }
}
