<?php

namespace App\Models\SafariAdvance\Traits;

trait SafariAdvanceAttribute
{
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
