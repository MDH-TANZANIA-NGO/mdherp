<?php

namespace App\Models\Employee;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Family extends BaseModel
{
    public function user(){
        return $this->belongsTo(User::class);
    }

}
