<?php


namespace App\Services\Workflow\Traits;


use Illuminate\Database\Eloquent\Model;

trait WorkflowResourceModificationStageTrait
{
    public function canEditResource(Model $model,$pending_level, $wf_definition)
    {
        $allow = false;
        switch($model->getTable()){
            /*Cov Cec Monthly Payment Module*/
            case 'cov_cec_monthly_payments':
                switch ($pending_level){
                    case 1: //Applicant level
                        if($model->user_id == access()->id()){
                            $allow = true;
                        }
                        break;
                    case 3: //Level 3
                        if(access()->hasWorkflowDefinitionProvided($wf_definition)){
                            $allow = true;
                        }
                        break;
                }
                break;
        }
        return $allow;
    }
}
