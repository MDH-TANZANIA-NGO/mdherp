<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\Unit\Designation;

class HrHireDesignationSkill extends BaseModel
{
     public $table = "hr_hire_designation_skills";

     public function designation(){
          return $this->belongsTo(Designation::class);
     }
     public function skill(){
          return $this->belongsTo(Skill::class);
     }
}
