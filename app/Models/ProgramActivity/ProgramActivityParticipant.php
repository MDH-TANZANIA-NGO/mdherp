<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\ProgramActivity\Traits\ProgramActivityParticipantRelationship;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityParticipant extends BaseModel
{
    //
    use ProgramActivityParticipantRelationship;
}
