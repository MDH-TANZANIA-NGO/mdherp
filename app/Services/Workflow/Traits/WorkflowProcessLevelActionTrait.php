<?php


namespace App\Services\Workflow\Traits;


use App\Models\Taf\Taf;
use App\Models\Tber\Tber;
use App\Repositories\Workflow\WfTrackRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;
use App\Models\Leave\Leave;

trait WorkflowProcessLevelActionTrait
{
    /**
     * Update rejected column
     * @param $wf_module_id
     * @param $resource_id
     * @param $sign
     * @return mixed
     */
    public function updateRejected($wf_module_id,$resource_id , $sign)
    {
        switch($wf_module_id){
            case 1:
                /*TAF*/
                $taf = Taf::query()->find($resource_id);
                return DB::transaction(function () use ($taf, $sign){
                    $rejected = 0;
                    if($sign == -1){
                        $rejected = 1;
                    }
                    return $taf->update(['rejected' => $rejected]);
                });
                break;
            case 2:
                /*TBER*/
                $tber = Tber::query()->find($resource_id);
                return DB::transaction(function () use ($tber, $sign){
                    $rejected = 0;
                    if($sign == -1){
                        $rejected = 1;
                    }
                    return $tber->update(['rejected' => $rejected]);
                });
                break;
                case 4:
                    /*Leave*/
                    $tber = Leave::query()->find($resource_id);
                    return DB::transaction(function () use ($tber, $sign){
                        $rejected = 0;
                        if($sign == -1){
                            $rejected = 1;
                        }
                        return $tber->update(['rejected' => $rejected]);
                    });
                    break;
        }

    }

    public function getResource($wf_module_id, $resource_id)
    {
        switch($wf_module_id){
            case 1:
                /*TAF*/
                    return Taf::query()->find($resource_id);
                break;
        }
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getApplicantLevel($wf_module_id)
    {
        $level = null;
        switch($wf_module_id){
            case 1:
                /*TAF*/
                $level = 1;
                break;
            case 2:
                /*TBER*/
                $level = 1;
                break;
                case 4:
                    /*LEAVE*/
                    $level = 1;
                    break;
        }
        return $level;
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getSupervisorLevel($wf_module_id)
    {
        $level = null;
        switch($wf_module_id){
            case 1:
                /*TAF*/
                $level = 2;
                break;
            case 2:
                /*TBER*/
                $level = 2;
                break;
                case 4:
                    /*LEAVE*/
                    $level = 2;
                    break;
        }
        return $level;
    }

    /**
     * Get applicant level
     * @param $wf_module_id
     * @return int|null
     * Get fron desk level per module id
     */
    public function getAccountReceivableLevel($wf_module_id)
    {
        $level = null;
        switch($wf_module_id){
            case 1:
                /*TAF*/
                $level = 5;
                break;
        }
        return $level;
    }

    /**
     * Process Workflow
     * @param $resource_id
     * @param $wf_module_id
     * @param $current_level
     * @param int $sign
     * @param array $inputs
     * @param null $wf_track_id
     * @return void
     */
    public function processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level,$level, $sign=0, array $inputs =[], $wf_track_id = null)
    {
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $supervisor_level = $this->getSupervisorLevel($wf_module_id);
        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);

        switch($level){
            case $applicant_level:
                $this->updateRejected($wf_module_id, $resource_id, $sign);
                /*Action on country director level*/
//                $this->sendApprovalNotification($report, $wf_definition->user);
                break;
            case $supervisor_level:
                $this->updateRejected($wf_module_id, $resource_id, $sign);
                break;
        }
        switch($current_level){
            case $account_receivable_level:
                switch($inputs['status']){
                    case 3: //holded
                        $this->updateWfDoneAndWfDoneDate($this->getResource($wf_module_id, $resource_id), $inputs['status']);
                        $this->holdWorkflow($wf_track_id, $inputs['status']);
                        break;
                    case 4: //
                        $this->updateWfDoneAndWfDoneDate($this->getResource($wf_module_id, $resource_id), $inputs['status']);
                        $this->completeWorkflow($wf_track_id, $inputs['status']);
                    break;
                    default:
                        break;
                }
                break;

        }
    }

    /**
     * updateWfDoneAndWfDoneDate
     * @param Model $model
     * @param $wf_done
     * @return mixed
     */
    public function updateWfDoneAndWfDoneDate(Model $model, $wf_done)
    {
        return DB::transaction(function () use ($model, $wf_done){
            return $model->update([
                'wf_done' => $wf_done,
                'wf_done_date' => Carbon::now()
            ]);
        });
    }

    /**
     * @param $wf_track_id
     * @param $status
     * @return mixed
     */
    public function completeWorkflow($wf_track_id, $status)
    {
        return DB::transaction(function () use ($wf_track_id, $status){
            $wf_track =(new WfTrackRepository())->find($wf_track_id);
            return $wf_track->update([
                'user_id' => access()->id(),
                'status' => $status,
                'assigned' => 1,
                'forward_date' => Carbon::now()
            ]);
        });
    }

    /**
     * @param $wf_track_id
     * @param $status
     * @return mixed
     */
    public function holdWorkflow($wf_track_id, $status)
    {
        return DB::transaction(function () use ($wf_track_id, $status){
            $wf_track =(new WfTrackRepository())->find($wf_track_id);
            return $wf_track->update([
                'user_id' => access()->id(),
                'status' => $status,
                'assigned' => 1,
            ]);
        });
    }
}
