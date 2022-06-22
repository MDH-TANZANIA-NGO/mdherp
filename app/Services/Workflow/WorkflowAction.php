<?php

namespace App\Services\Workflow;

use App\Models\Auth\User;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Notifications\Workflow\WorkflowNotification;
use App\Services\Workflow\Traits\WorkflowUserSelector;

class WorkflowAction {

    use WorkflowUserSelector;

    public function processNextLevel($wf_module_id,$resource_id, $level)
    {
        $data['next_user_id'] = null;
        switch($wf_module_id)
        {
            case 11:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $email_resource = (object)[
                            'link' =>  route('hr.pr.show',$pr_report),
                            'subject' =>  " Kindly review",
                            'message' => ' Performance Appraisal is on your level'
                        ];
                        User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                        break;

                    case 3:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $email_resource = (object)[
                            'link' =>  route('hr.pr.show',$pr_report),
                            'subject' =>  " Kindly review",
                            'message' => ' Performance Appraisal is on your level'
                        ];
                        User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                        break;
                    case 4:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $email_resource = (object)[
                            'link' =>  route('hr.pr.show',$pr_report),
                            'subject' =>  " Kindly review",
                            'message' => ' Performance Appraisal is on your level'
                        ];
                        User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    case 5:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $email_resource = (object)[
                            'link' =>  route('hr.pr.show',$pr_report),
                            'subject' =>  " Kindly review",
                            'message' => ' Performance Appraisal is on your level'
                        ];
                        User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                        break;
                }
                break;

            case 13:
                    $pr_report  = PrReport::query()->find($resource_id);
                    switch ($level) {
                        case 1: //Applicant level
                            $pr_report->update(['rejected' => false]);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                            $email_resource = (object)[
                                'link' =>  route('hr.pr.show',$pr_report),
                                'subject' =>  " Kindly review",
                                'message' => ' Performance Appraisal is on your level'
                            ];
                            User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
    
                        case 2:
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                            $email_resource = (object)[
                                'link' =>  route('hr.pr.show',$pr_report),
                                'subject' =>  " Kindly review",
                                'message' => ' Performance Appraisal is on your level'
                            ];
                            User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }
                    break;
        }
        return $data;
    }

}