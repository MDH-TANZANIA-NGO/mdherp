<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Skill extends BaseModel
{
    //
    public function category(){
        return $this->belongsTo(SkillCategory::class,'skill_category_id');
    }
   
}
