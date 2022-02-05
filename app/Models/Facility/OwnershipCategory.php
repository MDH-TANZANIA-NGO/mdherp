<?php

namespace App\Models\Facility;

use App\Models\Facility\Ownership;
use Illuminate\Database\Eloquent\Model;

class OwnershipCategory extends Model
{
    //
    public function ownerships()
    {
        return $this->hasMany(Ownership::class);
    }
}
