<?php

namespace App\Models\Payment;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Payment\Traits\Attributes\PaymentAttribute;
use App\Models\Payment\Traits\Relationship\PaymentRelationship;
use App\Models\ProgramActivity\ProgramActivityPayment;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Models\Requisition\Requisition;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
   use PaymentRelationship, PaymentAttribute;

public function activityPayment()
{
    return $this->hasOne(ProgramActivityPayment::class);
}

}
