<?php

namespace App\Listeners;

use App\Exceptions\GeneralException;
use App\Exceptions\WorkflowException;
use App\Models\SafariAdvance\SafariAdvanceDetails;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\Leave\LeaveRepository;
use App\Repositories\Listing\ListingRepository;
use App\Repositories\ProgramActivity\ProgramActivityReportRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\Timesheet\TimesheetRepository;
use App\Services\Workflow\Traits\WorkflowProcessLevelActionTrait;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Auth\User;
use League\CommonMark\Util\Html5EntityDecoder;
use PhpOffice\PhpSpreadsheet\Writer\Html;


class WorkflowEventSubscriber
{

    use WorkflowProcessLevelActionTrait, WorkflowUserSelector;
    /**
     * Handle on new workflow events.
     * @param $event
     * @throws \App\Exceptions\GeneralException
     */
    public function onNewWorkflow($event)
    {
        $input = $event->input;
        $par = $event->par;
        $extra = $event->extra;
        $resource_id = $input['resource_id'];
        $wf_module_group_id = $input['wf_module_group_id'];
        if(isset($input['type'])){
            $type = $input['type'];
        }else{
            $type = 0;
        }

        $data = [
            "resource_id" => $resource_id,
            "sign" => 1,
            "user_id" => access()->id(),
//            'port_id' => isset($input['port_id']) ? $input['port_id'] : null,
//            'zone_id' => isset($input['zone_id']) ? $input['zone_id'] : null,
            'region_id' => $input['region_id'],
        ];

        $data['comments'] = isset($extra['comments']) ? $extra['comments'] : "Recommended";
        $data['next_user_id'] = isset($extra['next_user_id']) ? $extra['next_user_id'] : NULL;
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $resource_id, 'type' => $type]);
        $workflow->createLog($data);
    }

    /**
     * Handle on approve workflow events.
     * @param $event
     * @throws WorkflowException
     * @throws \App\Exceptions\GeneralException
     */
    public function onApproveWorkflow($event)
    {
        $wfTrack = $event->wfTrack;
        $wf_module_id = $wfTrack->wfDefinition->wfModule->id;
        $level = $wfTrack->wfDefinition->level;
        $resource_id = $wfTrack->resource_id;
        $workflow = new Workflow(['wf_module_id' => $wf_module_id, 'resource_id' => $resource_id]);
        $sign = 1;
        $input = $event->input;
        $current_level = $wfTrack->wfDefinition->level;

        /* check if there is next level */
        if (!is_null($workflow->nextLevel())) {

            /* Create a entry log for the next workflow */
            $data = [
                'resource_id' => $resource_id,
                'sign' => $sign,
//                'port_id' => isset($input['port_id']) ? $input['port_id'] : null,
//                'zone_id' => isset($input['zone_id']) ? $input['zone_id'] : null,
                'region_id' => $input['region_id'],
            ];

            switch ($wf_module_id){
                    case 1:
                        $requisition_repo = (new RequisitionRepository());
                        $requisition = $requisition_repo->find($resource_id);
                        /*check levels*/
                        switch ($level){
                            case 1: //Applicant level
                                $requisition_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                                $string = htmlentities(
                                    "There is new"." ".$requisition->typeCategory->title." "."From ".$requisition->user->first_name."".$requisition->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                                    "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                                    "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                                    "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                                    "<b>Amount requested:</b>". number_2_format($requisition->amount)
                                );
                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => html_entity_decode($string)

                                ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;
                            case 2:
//                                $requisition_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                                $string = htmlentities(
                                    "There is new"." ".$requisition->typeCategory->title." "."From ".$requisition->user->first_name."".$requisition->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                                    "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                                    "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                                    "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                                    "<b>Amount requested:</b>". number_2_format($requisition->amount)
                                );
                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => html_entity_decode($string)
                                ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;

                                case 3:
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                                    $string = htmlentities(
                                        "There is new"." ".$requisition->typeCategory->title." "."From ".$requisition->user->first_name."".$requisition->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                                        "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                                        "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                                        "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                                        "<b>Amount requested:</b>". number_2_format($requisition->amount)
                                    );
                                    $email_resource = (object)[
                                        'link' =>  route('requisition.show',$requisition),
                                        'subject' => $requisition->typeCategory->title." Need your Approval",
                                        'message' => html_entity_decode($string)

                                    ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;

                            case 4:
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level,$requisition->user->designation->department_id);
                                $string = htmlentities(
                                    "There is new"." ".$requisition->typeCategory->title." "."From ".$requisition->user->first_name."".$requisition->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                                    "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                                    "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                                    "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                                    "<b>Amount requested:</b>". number_2_format($requisition->amount)
                                );
                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => html_entity_decode($string)
                                ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;

                            case 5:
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                                $string = htmlentities(
                                    "There is new"." ".$requisition->typeCategory->title." "."From ".$requisition->user->first_name."".$requisition->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                                    "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                                    "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                                    "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                                    "<b>Amount requested:</b>". number_2_format($requisition->amount)
                                );
                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => html_entity_decode($string)
                                ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;


                        }
                        break;
                case 3:
                    $safari_advance_repo_repo = (new SafariAdvanceRepository());
                    $safari = $safari_advance_repo_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level

                            $string = htmlentities(
                                "<p>There is new Safari Advance from"."<b> ".$safari->user->first_name. " ".$safari->user->last_name. "</b>"."Who is planning to travel to". "<b>".$safari->district->name."</b> </p><br>.".
                                        "<p><b>Scope:</b>".$safari->scope."</p>"
                            );
                            $safari_advance_repo_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);

                            $email_resource = (object)[
                                'link' => route('safari.show', $safari),
                                'subject' => $safari->number . " Need your Approval",
                                'message' =>  html_entity_decode($string)
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }

                    break;
                case 4:
                    $program_activity_repo = (new ProgramActivityRepository());
                    $program_activity = $program_activity_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level
                            $program_activity_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                            $string = htmlentities(
                                "There is new"." "."Program Activity Initiated"." "."by ".$program_activity->user->first_name."".$program_activity->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$program_activity->number."<br>".
                                "<b>Project:</b>".$program_activity->requisition->project->title." (". $program_activity->requisition->project->code.")"."<br>".
                                "<b>Activity:</b>".$program_activity->requisition->activity->code.": ".$program_activity->requisition->activity->title."<br>".
                                "<b>Activity Location:</b>". $program_activity->training->district->name."<br>".
                                "<b>Amount requested:</b>". number_2_format($program_activity->requisition->amount)
                            );
                            $email_resource = (object)[
                                'link' => route('programactivity.show', $program_activity),
                                'subject' =>  $program_activity->number . " Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }

                    break;
                case 5:
                    $retirement_repo = (new RetirementRepository());
                    $retirement = $retirement_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level
                            $retirement_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);

                            $email_resource = (object)[
                                'link' => route('retirement.show', $retirement),
                                'subject' => $retirement->number . " Need your Approval",
                                'message' =>  $retirement->number . ' need your approval'
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }

                    break;
                case 6:
                    $leave_repo = (new LeaveRepository());
                    $leave = $leave_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1:
                            //Applicant level
                            $string = htmlentities(
                                "There is new"." "."leave application"." "."from ".$leave->user->first_name."".$leave->user->last_name."pending for your approval."."<br>". "<br>".
                                "<b>Region:</b>".$leave->region->name."<br>".
                                "<b>Leave Type:</b>".$leave->type->name."<br>".
                                "<b>Remaining days:</b>".$leave->getRemainingDays()."<br>".
                                "<b>Comments:</b>". $leave->comment."<br>".
                                "<b>Starting Date</b>". $leave->start_date."<br>".
                                "<b>End Date</b>". $leave->end_date."<br>".
                                "<b>Requested Days</b>". getNoDays($leave->start_date, $leave->end_date)."<br>"

                            );
                            $leave_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);

                            $email_resource = (object)[
                                'link' => route('leave.show', $leave),
                                'subject' => $leave->id . " Needs your Approval",
                                'message' => html_entity_decode($string)
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                        case 2:
//                                $leave_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);

                            $string = htmlentities(
                                "There is new"." "."leave application"." "."from ".$leave->user->first_name."".$leave->user->last_name."pending for your approval."."<br>". "<br>".
                                "<b>Region:</b>".$leave->region->name."<br>".
                                "<b>Leave Type:</b>".$leave->type->name."<br>".
                                "<b>Remaining days:</b>".$leave->getRemainingDays()."<br>".
                                "<b>Comments:</b>". $leave->comment."<br>".
                                "<b>Starting Date</b>". $leave->start_date."<br>".
                                "<b>End Date</b>". $leave->end_date."<br>".
                                "<b>Requested Days</b>". getNoDays($leave->start_date, $leave->end_date)."<br>"

                            );
                            $email_resource = (object)[
                                'link' =>  route('leave.show',$leave),
                                'subject' => $leave->id." Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
                           // User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;

                        case 3:
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                            $string = htmlentities(
                                "There is new"." "."leave application"." "."from ".$leave->user->first_name."".$leave->user->last_name."pending for your approval."."<br>". "<br>".
                                "<b>Region:</b>".$leave->region->name."<br>".
                                "<b>Leave Type:</b>".$leave->type->name."<br>".
                                "<b>Remaining days:</b>".$leave->getRemainingDays()."<br>".
                                "<b>Comments:</b>". $leave->comment."<br>".
                                "<b>Starting Date</b>". $leave->start_date."<br>".
                                "<b>End Date</b>". $leave->end_date."<br>".
                                "<b>Requested Days</b>". getNoDays($leave->start_date, $leave->end_date)."<br>"

                            );
                            $email_resource = (object)[
                                'link' =>  route('leave.show',$leave),
                                'subject' => $leave->id." Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
                            //User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;

                        case 4:
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level,$leave->user->designation->department_id);
                            $string = htmlentities(
                                "There is new"." "."leave application"." "."from ".$leave->user->first_name."".$leave->user->last_name."pending for your approval."."<br>". "<br>".
                                "<b>Region:</b>".$leave->region->name."<br>".
                                "<b>Leave Type:</b>".$leave->type->name."<br>".
                                "<b>Remaining days:</b>".$leave->getRemainingDays()."<br>".
                                "<b>Comments:</b>". $leave->comment."<br>".
                                "<b>Starting Date</b>". $leave->start_date."<br>".
                                "<b>End Date</b>". $leave->end_date."<br>".
                                "<b>Requested Days</b>". getNoDays($leave->start_date, $leave->end_date)."<br>"

                            );
                            $email_resource = (object)[
                                'link' =>  route('leave.show',$leave),
                                'subject' => $leave->id." Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
                           // User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;

                        case 5:
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                            $string = htmlentities(
                                "There is new"." "."leave application"." "."from ".$leave->user->first_name."".$leave->user->last_name."pending for your approval."."<br>". "<br>".
                                "<b>Region:</b>".$leave->region->name."<br>".
                                "<b>Leave Type:</b>".$leave->type->name."<br>".
                                "<b>Remaining days:</b>".$leave->getRemainingDays()."<br>".
                                "<b>Comments:</b>". $leave->comment."<br>".
                                "<b>Starting Date</b>". $leave->start_date."<br>".
                                "<b>End Date</b>". $leave->end_date."<br>".
                                "<b>Requested Days</b>". getNoDays($leave->start_date, $leave->end_date)."<br>"

                            );
                            $email_resource = (object)[
                                'link' =>  route('leave.show',$leave),
                                'subject' => $leave->id." Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
                            User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;

                    }

                    break;
                case 7:
                    $payment_repo = (new FinanceActivityRepository());
                    $payment = $payment_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level
                            $payment_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);
                            $string = htmlentities(
                                "There is new"." "."Payment batch"." "."from ".$payment->user->first_name."".$payment->user->last_name."pending your approval."."<br>". "<b>Number:</b>".$payment->number."<br>".
                                "<b>Project:</b>".$payment->requisition->project->title." (". $payment->requisition->project->code.")"."<br>".
                                "<b>Activity:</b>".$payment->requisition->activity->code.": ".$payment->requisition->activity->title."<br>".
                                "<b>Amount requested:</b>". number_2_format($payment->requisition->amount)
                            );
                            $email_resource = (object)[
                                'link' => route('programactivity.show', $payment),
                                'subject' =>  $payment->number . " Need your Approval",
                                'message' => html_entity_decode($string)
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }

                    break;
                case 8:
                    $timesheet_repo = (new TimesheetRepository());
                    $timesheet  = $timesheet_repo ->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level
                            $timesheet_repo ->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);

                            $email_resource = (object)[
                                'link' => route('timesheet.show', $timesheet),
                                'subject' => $timesheet->id . " Need your Approval",
                                'message' =>  $timesheet->id . ' need your approval'
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }
                    break;

                case 9:
                    $listing_repo = (new ListingRepository());
                    $listing  = $listing_repo->find($resource_id);
                    /*check levels*/
                    switch ($level) {
                        case 1: //Applicant level
//                            $listing_repo ->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $listing->update(['rejected' => false]);
                            $data['next_user_id'] = $this->nextUserSelector($wf_module_id, $resource_id, $level);

                            $email_resource = (object)[
                                'link' => route('listing.show', $listing),
                                'subject' => $listing->id . " Needs your Approval",
                                'message' =>  $listing->id . ' needs your approval'
                            ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                            break;
                    }
                    break;

            }

            $workflow->forward($data);
        } else {
            /* Workflow completed */
            /* Process for specific resource on workflow completion */
            switch ($wf_module_id) {
                case 1: case 2:
                    $requisition_repo = (new RequisitionRepository());
                    $requisition = $requisition_repo->find($resource_id);
                    $this->updateWfDone($requisition);
                    $requisition_repo->processComplete($requisition);
                $string = htmlentities(
                    "Your"." ".$requisition->typeCategory->title." "."has been approved successfully."."<br>". "<b>Number:</b>".$requisition->number."<br>".
                    "<b>Project:</b>".$requisition->project->title." (". $requisition->project->code.")"."<br>".
                    "<b>Activity:</b>".$requisition->activity->code.": ".$requisition->activity->title."<br>".
                    "<b>Requisition Description:</b>". $requisition->descriptions."<br>".
                    "<b>Amount requested:</b>". number_2_format($requisition->amount)."(TZS)". "which is equal to". number_2_format(currency_converter($requisition->amount, 'TSH'))."(USD)"
                );
                    $email_resource = (object)[
                        'link' =>  route('requisition.show',$requisition),
                        'subject' => $requisition->typeCategory->title." ".$requisition->number." Approved Successfully",
                        'message' => html_entity_decode($string)
                    ];
                    $requisition->user->notify(new WorkflowNotification($email_resource));
                    break;
                case 3:
                $safari_advance_repo = (new SafariAdvanceRepository());
                $safari = $safari_advance_repo->find($resource_id);
                $this->updateWfDone($safari);
//                $requisition_repo->processComplete($safari);
                $email_resource = (object)[
                    'link' =>  route('safari.show',$safari),
                    'subject' => $safari->number." Approved Successfully",
                    'message' => $safari->number.': This Safari Advance has been Approved successfully'
                ];
                $admin_email = (object)[
                        'link' =>  route('safari.show',$safari),
                        'subject' => " Arrange Logistics For Safari".$safari->number,
                        'message' =>$safari->user->full_name. " Will travell to.".$safari->region->name." From".$safari->SafariDetails->from. "To". $safari->SafariDetails->to."Kindly Prepare logistics for this safari",
                    ];
                $safari->user->notify(new WorkflowNotification($email_resource));
                $projectAdmin = User::query()->where('region_id', $safari->region_id)->where('designation_id', '=', 43)->first();
                $projectAdmin->notify(new WorkflowNotification($admin_email));
                break;
                case 4:
                    $program_activity_repo = (new ProgramActivityRepository());
                    $program_activity = $program_activity_repo->find($resource_id);
                    $this->updateWfDone($program_activity);
//                $requisition_repo->processComplete($safari);
                    $email_resource = (object)[
                        'link' =>  route('programactivity.show',$program_activity),
                        'subject' => $program_activity->number." Approved Successfully",
                        'message' => $program_activity->number.': This Activity has been Approved successfully'
                    ];
                    $admin_email = (object)[
                        'link' =>  route('programactivity.show',$program_activity),
                        'subject' =>" Arrange Logistics For Program Activity:". $program_activity->number,
                        'message' =>$program_activity->user->full_name. " Will conduct Program Activity in your Region From".$program_activity->training->from. "To". $program_activity->training->to,
                    ];
                    $program_activity->user->notify(new WorkflowNotification($email_resource));
                    $projectAdmin = User::query()->where('region_id', $program_activity->user->region_id)->where('designation_id', '=', 43)->first();

                    $projectAdmin->notify(new WorkflowNotification($admin_email));

                    break;
                case 5:
                    $retirement_repo = (new RetirementRepository());
                    $retirement = $retirement_repo->find($resource_id);
                    $this->updateWfDone($retirement);
//                $requisition_repo->processComplete($safari);
                    $email_resource = (object)[
                        'link' =>  route('retirement.show',$retirement),
                        'subject' => $retirement->number." Approved Successfully",
                        'message' => 'The Retirement has been Approved successfully'
                    ];
                    $retirement->user->notify(new WorkflowNotification($email_resource));
                    break;
                case 6:
                    $leave_repo = (new LeaveRepository());
                    $leave = $leave_repo->find($resource_id);
                    $this->updateWfDone($leave);
                    $email_resource = (object)[
                        'link' =>  route('leave.show',$leave),
                        'subject' => "Approved Successfully",
                        'message' => 'The Leave Application has been Approved successfully'
                    ];
                    $delegeted_email = (object)[
                        'link' =>  route('leave.show',$leave),
                        'subject' => "Delegated Responsibilities",
                        'message' => $leave->user->first_name. ' '.$leave->user->last_name. 'Have gone for '. $leave->balance->leaveType->name. 'until'.' '. $leave->end_date. '. You have been delegated hi/her responsibilities.'
                    ];
                    $delegeted_user = User::query()->where('id', $leave->employee_id)->first();
                    $leave->user->notify(new WorkflowNotification($email_resource));
                    $delegeted_user->notify(new WorkflowNotification($delegeted_email));
                    break;
                case 7:
                    $finance_repo = (new FinanceActivityRepository());
                    $finance = $finance_repo->find($resource_id);

                    $this->updateWfDone($finance);
//                $requisition_repo->processComplete($safari);
                    $email_resource = (object)[
                        'link' =>  route('finance.view',$finance),
                        'subject' => $finance->number." Approved Successfully",
                        'message' => $finance->number.':This payment batch has been Approved successfully'
                    ];
                    $activity_owner_email = (object)[
                        'link' =>  route('programactivityreport.show',$finance->activityPayment->activityReport->uuid),
                        'subject' => "Activity Payment Approved",
                        'message' => 'Your activity payments has been approved'
                    ];
                    $activity_owner = User::query()->where('id', $finance->activityPayment->activityReport->user_id)->first();
                    $finance->user->notify(new WorkflowNotification($email_resource));
                    $activity_owner->notify(new WorkflowNotification(($activity_owner_email)));
                    break;
                case 8:
                    $timesheetrepo = (new TimesheetRepository());
                    $timesheet = $timesheetrepo->find($resource_id);
                    $this->updateWfDone($timesheet);
                    $email_resource = (object)[
                        'link' =>  route('timesheet.show',$timesheet),
                        'subject' => "Approved Successfully",
                        'message' => 'These Timesheet has been Approved successfully'
                    ];
                    $timesheet->user->notify(new WorkflowNotification($email_resource));
                    break;
                case 9:
                    $listingrepo = (new ListingRepository());
                    $listing = $listingrepo->find($resource_id);
                    $this->updateWfDone($listing);
                    $email_resource = (object)[
                        'link' =>  route('listing.show',$listing),
                        'subject' => "Approved Successfully",
                        'message' => 'This Hire Requisition has been Approved successfully'
                    ];
                    $listing->user->notify(new WorkflowNotification($email_resource));
                    break;
                case 10:
                    $program_activity_report_repo = (new ProgramActivityReportRepository());
                    $program_activity_report = $program_activity_report_repo->find($resource_id);
                    $this->updateWfDone($program_activity_report);
                    $email_resource = (object)[
                        'link' =>  route('programactivityreport.show',$program_activity_report),
                        'subject' => $program_activity_report->number.": Has been Approved Successfully",
                        'message' => $program_activity_report->number.'This  Activity Report has been Approved successfully'
                    ];
                    $program_activity_report->user->notify(new WorkflowNotification($email_resource));
                    break;
            }


        }
    }

    /**
     * Handle on reject workflow events.
     * @param $event
     * @throws \App\Exceptions\GeneralException
     */
    public function onRejectWorkflow($event)
    {
        $wfTrack = $event->wfTrack;
        $level = $event->level;
        $workflow = new Workflow(['wf_module_id' => $wfTrack->wfDefinition->wfModule->id, 'resource_id' => $wfTrack->resource_id]);
        $sign = -1;
        /* check if there is next level */
        if (!is_null($workflow->prevLevel())) {
            $data = [
                'resource_id' => $wfTrack->resource_id,
                'sign' => $sign,
                'level' => $level,
                'region' => $wfTrack->region_id,
            ];

            $workflow->forward($data);

        }

        $wf_module_id = $wfTrack->wfDefinition->wfModule->id;
        $resource_id = $wfTrack->resource_id;
        $current_level = $wfTrack->wfDefinition->level;

        switch ($wf_module_id) {
            case 1: case 2:
                (new RequisitionRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 3:
                (new SafariAdvanceRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 4:
                (new ProgramActivityRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 5:
                (new RetirementRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 6:
                (new LeaveRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 7:
                (new FinanceActivityRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 8:
                (new TimesheetRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 9:
                (new ListingRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 10:
                (new ProgramActivityReportRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;

        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'App\Events\ApproveWorkflow',
            'App\Listeners\WorkflowEventSubscriber@onApproveWorkflow'
        );

        $events->listen(
            'App\Events\NewWorkflow',
            'App\Listeners\WorkflowEventSubscriber@onNewWorkflow'
        );

        $events->listen(
            'App\Events\RejectWorkflow',
            'App\Listeners\WorkflowEventSubscriber@onRejectWorkflow'
        );

    }

    private function updateWfDone(Model $model)
    {
        $model->update(['wf_done' => 1, 'wf_done_date' => Carbon::now()]);
    }


}
