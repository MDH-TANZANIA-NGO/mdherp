<?php

namespace App\Models\SafariAdvance;

use App\Models\BaseModel;
use App\Models\SafariAdvance\Traits\SafariAdvanceAttribute;
use App\Models\SafariAdvance\Traits\SafariAdvanceRelationship;
use Illuminate\Database\Eloquent\Model;

class SafariAdvanceDetails extends BaseModel
{
    //
    use  SafariAdvanceRelationship, SafariAdvanceAttribute;


}
