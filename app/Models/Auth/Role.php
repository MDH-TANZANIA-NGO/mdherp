<?php

namespace App\Models\Auth;

use App\Models\Auth\RoleAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Relationship\RoleRelationship;
use App\Models\Auth\Attribute\RoleAttribute;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
    use  RoleAttribute, RoleRelationship, RoleAccess, Auditable;


    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
    ];

}
