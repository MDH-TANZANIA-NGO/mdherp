<?php

namespace App\Listeners;

use App\Exceptions\GeneralException;
use App\Exceptions\WorkflowException;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Services\Workflow\Traits\WorkflowProcessLevelActionTrait;
use App\Services\Workflow\Traits\WorkflowUserSelector;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Auth\User;


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

                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => $requisition->typeCategory->title." ".$requisition->number.' need your approval'
                                ];
//                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;
                            case 2:
//                                $requisition_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);

                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => $requisition->typeCategory->title." ".$requisition->number.' need your approval'
                                ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;

                                case 3:
                                $data['next_user_id'] = $this->nextUserSelector($wf_module_id,$resource_id,$level);
                                $email_resource = (object)[
                                    'link' =>  route('requisition.show',$requisition),
                                    'subject' => $requisition->typeCategory->title." Need your Approval",
                                    'message' => $requisition->typeCategory->title." ".$requisition->number.' need your approval'
                                ];
                                User::query()->find($data['next_user_id'])->notify(new WorkflowNotification($email_resource));
                                break;


                        }
                        break;
                case 2:

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
                    $email_resource = (object)[
                        'link' =>  route('requisition.show',$requisition),
                        'subject' => $requisition->typeCategory->title." ".$requisition->number." Approved Successfully",
                        'message' => 'These Application has been Approved successfully'
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
                    'message' => 'These Application has been Approved successfully'
                ];
                $admin_email = (object)[
                        'link' =>  route('safari.show',$safari),
                        'subject' => $safari->number." Arrange Logistics For Safari",
                        'message' =>$safari->user->full_name. " Will be in Your Region From".$safari->SafariDetails->from. "To". $safari->SafariDetails->to,
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
                        'message' => 'These Application has been Approved successfully'
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
                case 7:
                    $financerepo = (new FinanceActivityRepository());
                    $finance = $financerepo->find($resource_id);
                    $this->updateWfDone($finance);
//                $requisition_repo->processComplete($safari);
                    $email_resource = (object)[
                        'link' =>  route('finance.view',$finance),
                        'subject' => $finance->number." Approved Successfully",
                        'message' => 'These Application has been Approved successfully'
                    ];
                    $finance->user->notify(new WorkflowNotification($email_resource));
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
            case 1:
                (new RequisitionRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
                break;
            case 5:
                (new RetirementRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign,['rejected_level' => $level]);
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
