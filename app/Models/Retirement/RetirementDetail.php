<?php

namespace App\Models\Retirement;
use App\Models\BaseModel;

use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RetirementDetail extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
