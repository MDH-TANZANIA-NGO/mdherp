<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Interview extends BaseModel
{
    protected $table = 'hr_interviews';

    public function questions(){
        return $this->hasManyThrough(Questions::class,InterviewQuestion::class);
    }
    public function InterviewType(){
        return $this->belongsTo(InterviewType::class,'interview_type_id');
    }
}
