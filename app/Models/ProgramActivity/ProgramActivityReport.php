<?php

namespace App\Models\ProgramActivity;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\ProgramActivity\Traits\ProgramActivityReportAttribute;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityReport extends BaseModel
{
    //
use ProgramActivityReportAttribute;
    public function programActivity(){
        return $this->belongsTo(ProgramActivity::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function payment()
    {
        return $this->hasOne(ProgramActivityPayment::class,'program_activity_report_id', 'id');
    }
}
