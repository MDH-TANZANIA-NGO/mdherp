<?php

namespace App\Listeners;

use App\Exceptions\WorkflowException;
use App\Models\Cov_Cec_Payment_Module\CovCecMonthlyPayment;
use App\Models\Tber\Tber;
use App\Repositories\Cov_Cec_Payment_Module\CovCecMonthlyPaymentRepository;
use App\Models\Leave\Leave;
use App\Repositories\taf\TafRepository;
use App\Repositories\Tber\TberRepository;
use App\Repositories\Leave\LeaveRepository;
use App\Repositories\Leave\LeaveDateRepository;                                      
use App\Repositories\Workflow\WfTrackRepository;
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
                case 1: //TAF
                    $taf_repo = (new TafRepository());
                    $taf = $taf_repo->find($resource_id);

                    /*check if trips are not done / finished*/
                    if  (checkIfTripsAreDone($taf)){
                        throw new WorkflowException('Please complete all the trips');
                    }
                    /*check levels*/
                    switch ($level){
                        case 1: //Applicant level
                            $taf_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $supervisor_id = $taf_repo->find($resource_id)->supervisor_id;
                            $data['next_user_id'] = $supervisor_id;
                            break;
//                        case 5: //Accountant receivable level
//                            $taf_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign, $input);
//                            break;
                    }
                    break;
                case 2:
                    /*TBER*/
                    $tber = Tber::query()->find($resource_id);

                    /*check levels*/
                    switch ($level){
                        case 1: //
                            $this->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            $supervisor_id = $tber->supervisor_id ? $tber->supervisor_id : access()->user()->assignedSupervisor()->supervisor_id;
                            $data['next_user_id'] = $supervisor_id;
                            break;
                        case 4:
                            $this->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                            break;
                    }
                    break;


                case 4:
                    /*Cov Cec Monthly Payment*/
                    $cov_cec_monthly_payment = CovCecMonthlyPayment::query()->find($resource_id);
                    /*check levels*/
                    switch ($level){
                        case 1: //
                            /*check if trips are not done / finished*/
                            if  (documents($cov_cec_monthly_payment, 3)->count() == 0){
                                throw new WorkflowException('Please Upload supporting document before proceed');
                            }

                            (new CovCecMonthlyPaymentRepository())->processWorkflowLevelsAction($resource_id,$wf_module_id, $level, $sign,['current_level' => $current_level]);
                            $data['next_user_id'] = $this->nextUserSelector($workflow->nextDefinition($sign), $cov_cec_monthly_payment->region_id);
                            break;
                    }
                    break;

                    case 5: //Leave
                        $leave_repo = (new LeaveRepository());
                        $leave = $leave_repo->find($resource_id);
                        /*check levels*/
                        switch ($level){
                            case 1: //Applicant level
                                $leave_repo->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                                $supervisor_id = access()->user()->assignedSupervisor()->supervisor_id;
                                $data['next_user_id'] = $supervisor_id;
                                break;
                        }
                        break;
            }

            $workflow->forward($data);
        } else {
            /* Workflow completed */
            /* Process for specific resource on workflow completion */
            switch ($wf_module_id) {
                case 1:
                    $taf = (new TafRepository())->find($resource_id);
                    $this->updateWfDone($taf);
                    break;

                case 2:
                    $tber = Tber::query()->find($resource_id);
                    $this->updateWfDone($tber);
                    break;
                case 4:
                    $cov_cec_monthly_payment = (new CovCecMonthlyPaymentRepository())->find($resource_id);
                    $this->updateWfDone($cov_cec_monthly_payment);
                    break;

                    case 5:
                        $leave = Leave::query()->find($resource_id);
                        (new LeaveDateRepository())->store($leave);
                        $this->updateWfDone($leave);
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
                /*TAF*/
                (new TafRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign);
                break;
            case 2:

                /*TBER*/
                $this->processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level,$level, $sign);
                break;

            case 4:
                /*Cov Cec Monthly Payment*/
                (new CovCecMonthlyPaymentRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
                break;

                case 5:
                    /*Leave*/
                    (new LeaveRepository())->processWorkflowLevelsAction($resource_id, $wf_module_id, $level, $sign);
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
