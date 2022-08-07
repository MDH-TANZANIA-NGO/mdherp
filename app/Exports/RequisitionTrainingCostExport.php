<?php

namespace App\Exports;

use App\Models\Requisition\Training\requisition_training_cost;
//use App\Models\requisition_training_cost;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RequisitionTrainingCostExport implements FromCollection, WithMapping, WithHeadings
{
    protected $training_cost;
    public function __construct($activity_report)
    {
        $this->activity_report =  $activity_report;
        $this->training_cost = (new RequestTrainingCostRepository());

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return $this->training_cost->getParticipantsByRequisition($this->activity_report->requisition_id)->get();
    }
    public function map($row): array
    {
        return [
            $row->user->first_name,
            $row->user->last_name,
            substr($row->user->phone, -9),
            $row->perdiem_total_amount,
            $row->transportation,
            $row->other_cost,
            $row->others_description,
            $row->amount_paid,
            $row->total_amount,

        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Phone',
            'Total Perdiem',
            'Transport Cost',
            'Other Costs',
            'Other Cost Description',
            'Amount Paid',
            'Total Amount Requested'
        ];
    }
}
