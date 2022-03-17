<?php

namespace App\Models\Userbio;

use App\Models\Auth\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Userbio extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    public  function user()
    {
        return $this->belongsTo(User::class);
    }

}
