<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserContractAttribute;
use App\Models\Auth\Relationship\UserContractRelationship;
use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModel;

class UserContract extends BaseModel
{
    use UserContractAttribute, UserContractRelationship;
}
