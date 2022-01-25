<?php

namespace App\Exports;

use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_cost;
use http\Env\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentExport implements FromQuery
{

    protected $uuid;

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }




    public function query()
    {
        $uuid= $this->uuid;
        $requisition_id = ProgramActivity::where('uuid', $uuid)->get()->first()->requisition_id;
        $participant = requisition_training_cost::where('requisition_id', $requisition_id)->get()->first();
        // TODO: Implement query() method.
        dd();
        return $participant;


    }
}
