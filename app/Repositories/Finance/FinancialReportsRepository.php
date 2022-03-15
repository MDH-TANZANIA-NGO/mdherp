<?php

namespace App\Repositories\Finance;

use App\Models\Auth\User;
use App\Models\Payment\Payment;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class FinancialReportsRepository extends BaseRepository
{
    const MODEL = Payment::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('payments.id AS id'),
            DB::raw('payments.user_id AS user_id'),
            DB::raw('payments.number AS number'),
            DB::raw('payments.requested_amount AS requested_amount'),
            DB::raw('payments.payed_amount AS payed_amount'),
            DB::raw('payments.created_at AS created_at'),
            DB::raw('payments.region_id AS region_id'),
            DB::raw('payments.uuid AS uuid'),
            DB::raw('users.id AS user_ID'),
        ])
            ->join('users', 'users.id', 'payments.user_id');
    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('payments.wf_done_date', null)
//            ->where('safari_advances.done', true)
            ->where('payments.rejected', false);


    }

    public function getAccessApprovedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('payments.wf_done', 1)
//            ->where('safari_advances.done', true)
            ->where('payments.rejected', false);

    }

    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('payments.wf_done', 1)
//            ->where('safari_advances.done', true)
            ->where('payments.rejected', true)
            ->where('payments.user_id', access()->user()->id);

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
        switch ($wf_module_id) {
            case 1:
                $level = 1;
                break;
        }
        return $level;
    }

    public function processWorkflowLevelsAction($resource_id, $wf_module_id, $current_level, $sign = 0, array $inputs = [])
    {
        $retirement = $this->find($resource_id);
        $applicant_level = $this->getApplicantLevel($wf_module_id);
        $head_of_dept_level = $this->getHeadOfDeptLevel($wf_module_id);
//        $account_receivable_level = $this->getAccountReceivableLevel($wf_module_id);
//        if($retirement->rejected){}
        switch ($inputs['rejected_level'] ?? $current_level) {
            case $applicant_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('retirement.show', $retirement),
                    'subject' => $retirement->number . " Has been revised to your level",
                    'message' => $retirement->number . ' need modification.. Please do the need and send it back for approval'
                ];
                User::query()->find($retirement->user_id)->notify(new WorkflowNotification($email_resource));

                break;
            case $head_of_dept_level:
                $this->updateRejected($resource_id, $sign);

                $email_resource = (object)[
                    'link' => route('requisition.show', $retirement),
                    'subject' => $retirement->number . " Has been revised to your level",
                    'message' => $retirement->number  . ' need modification.. Please do the need and send it back for approval'
                ];
                //     User::query()->find($this->nextUserSelector($wf_module_id, $resource_id, $current_level))->notify(new WorkflowNotification($email_resource));

                break;
        }
    }



    public function getHeadOfDeptLevel($wf_module_id)
    {
        $level = null;
        switch ($wf_module_id) {
            case 1:
                $level = 2;
                break;
        }
        return $level;
    }

    public function updateRejected($id, $sign)
    {
        $retirement = $this->query()->find($id);
        return DB::transaction(function () use ($retirement, $sign) {
            $rejected = FALSE;
            if ($sign == -1) {
                $rejected = TRUE;
            }
            return $retirement->update(['rejected' => $rejected]);
        });
    }

}
