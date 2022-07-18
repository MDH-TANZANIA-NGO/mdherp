<?php

namespace App\Models\Fleet;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;
use App\Models\Auth\User;

class Fleet extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
