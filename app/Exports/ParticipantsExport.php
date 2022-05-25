<?php

namespace App\Exports;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;



class ParticipantsExport implements FromCollection, WithMapping, WithHeadings
{

    protected $program_activity;
    protected $requisition_training_cost;

    public function __construct( $program_activity)
    {

        $this->program_activity = $program_activity;
        $this->requisition_training_cost =  (new RequestTrainingCostRepository());


    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $attendance = $this->program_activity->attendance()->getQuery()->get();
        dd($this->program_activity->attendance()->getDataForPaymentExport($this->program_activity->id));
        $requisition_training = $this->requisition_training_cost->getActivityParticipants($this->program_activity->uuid)->get();
         return $requisition_training;
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
