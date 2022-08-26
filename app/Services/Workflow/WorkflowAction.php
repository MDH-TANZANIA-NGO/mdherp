<?php

namespace App\Services\Workflow;

use App\Jobs\Workflow\SendEmail;
use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRequest;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Notifications\Workflow\WorkflowNotification;
use App\Services\Workflow\Traits\WorkflowUserSelector;

class WorkflowAction
{

    use WorkflowUserSelector;

    public function processNextLevelMail($wf_module_id, $resource_id, $next_user_id)
    {
        switch($wf_module_id)
        {
            case 11:case 21:case 22:case 23:case 24:
                $pr_report  = PrReport::query()->find($resource_id);
                $next_user = User::find($next_user_id);
                $email_resource =  (object)[
                    'link' =>  route('hr.pr.show', $pr_report),
                    'subject' =>  " Kindly review",
                    'message' => 'Dear '.$next_user->fullname.', Perfomance appraisal for '.$pr_report->user->fullname.' needs your approval'
                ];
                SendEmail::dispatch(User::query()->find($next_user_id), $email_resource);
            break;
        }
    }

    public function processNextLevel($wf_module_id, $resource_id, $level)
    {
        $data['next_user_id'] = null;
        switch ($wf_module_id) {
            case 11:
            case 24:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;

                    case 2:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 3:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 4:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 5:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                }
                break;

            case 13:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;

                    case 2:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                }
                break;

            case 19:
                $hr_applicant_request  = HrHireRequisitionJobApplicantRequest::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $hr_applicant_request->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $email_resource = (object)[
                            'link' =>  route('job_applicant_request.show', $hr_applicant_request),
                            'subject' =>  "Kindly approve Shortlisted Report",
                            'message' => 'Kindly approve Shortlisted Report'
                        ];
                        User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                        break;
                }
                break;

            case 21:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;

                    case 2:
                        $department_id = $pr_report->user->designation->department_id;
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level, $department_id);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 3:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                    case 4:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                }
                break;

            case 22:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;

                    case 2:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 3:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                }
                break;
            case 23:
                $pr_report  = PrReport::query()->find($resource_id);
                switch ($level) {
                    case 1: //Applicant level
                        $pr_report->update(['rejected' => false]);
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;

                    case 2:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                    case 3:
                        $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                        $this->processNextLevelMail($wf_module_id, $resource_id, $data['next_user_id']);
                        break;
                }
                break; 
        }
        return $data;
    }
}
