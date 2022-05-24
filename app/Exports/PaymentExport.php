<?php

namespace App\Exports;

use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use http\Env\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentExport implements FromCollection, WithMapping, WithHeadings
{

    protected $attendance_on_reporting_date;
    protected $requisition_training_cost;

    public function __construct( $attendance_on_reporting_date)
    {

        $this->attendance_on_reporting_date = $attendance_on_reporting_date;
        $this->requisition_training_cost =  (new RequestTrainingCostRepository());


    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->attendance_on_reporting_date;
    }

    public function map($row): array
    {
        return [
            $row->first_name,
            $row->last_name,
            substr($row->phone, -9),
            $row->perdiem_total_amount,
            $row->transportation,
            $row->other_cost,
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
            'Amount Paid',
            'Total Amount Requested'
        ];
    }
}
