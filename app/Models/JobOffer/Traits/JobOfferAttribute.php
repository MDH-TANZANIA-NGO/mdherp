<?php
namespace App\Models\JobOffer\Traits;
trait JobOfferAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
