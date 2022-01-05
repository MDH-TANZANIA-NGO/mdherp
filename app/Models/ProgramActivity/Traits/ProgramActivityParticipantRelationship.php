<?php

namespace App\Models\ProgramActivity\Traits;

use App\Models\ProgramActivity\ProgramActivity;

trait ProgramActivityParticipantRelationship
{
public function programActivity()
{
    return $this->belongsTo(ProgramActivity::class);
}
}
