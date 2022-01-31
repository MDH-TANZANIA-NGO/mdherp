<?php

namespace App\Repositories\Finance;

use App\Models\Payment\Payment;
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
            ->join('users','users.id', 'payments.user_id');
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
            ->where('payments.wf_done', true)
//            ->where('safari_advances.done', true)
            ->where('payments.rejected', false);

    }
}
