<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserContractProjectAttribute;
use App\Models\Auth\Relationship\UserContractProjectRelationship;
use Illuminate\Database\Eloquent\Model;

class UserContractProject extends Model
{
    use UserContractProjectAttribute, UserContractProjectRelationship;
}
