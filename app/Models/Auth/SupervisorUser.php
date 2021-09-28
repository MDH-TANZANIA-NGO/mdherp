<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\SupervisorUserAttribute;
use App\Models\Auth\Relationship\SupervisorUserRelationship;
use Illuminate\Database\Eloquent\Model;

class SupervisorUser extends Model
{
    use SupervisorUserAttribute, SupervisorUserRelationship;
    protected $table = 'supervisor_users';
    protected $guarded = [];
}
