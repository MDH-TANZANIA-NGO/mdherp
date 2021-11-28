<?php


namespace App\Services\Workflow\Traits;


use Illuminate\Database\Eloquent\Model;

trait WorkflowResourceModificationStageTrait
{
    public function canEditResource(Model $model,$pending_level, $wf_definition)
    {
        $allow = false;
        switch($model->getTable()){
            /*requisitions Module*/
            case 'requisitions':
                switch ($pending_level){
                    case 1: //Applicant level
                        if($model->user_id == access()->id()){
                            $allow = true;
                        }
                        break;
//                    case 3: //Level 3
//                        if(access()->hasWorkflowDefinitionProvided($wf_definition)){
//                            $allow = true;
//                        }
//                        break;
                }
                break;
        }
        return $allow;
    }
}
