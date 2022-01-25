<?php

namespace App\Exports;

use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{

    protected $uuid;

    public function __construct()
    {
        $uuid = Payment::all()->training->trainingCost()->get()->all();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
   {

       // TODO: Implement view() method.

       return view('finance.payments.Exports.participantsExport',
       [

       ]);
   }
}
