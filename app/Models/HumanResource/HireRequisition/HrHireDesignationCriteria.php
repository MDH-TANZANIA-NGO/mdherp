<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
class HrHireDesignationCriteria extends BaseModel
{
     public $table = "hr_hire_designation_criterias";

     public function criteriable(){
          return $this->morphTo();
     }
     
}
