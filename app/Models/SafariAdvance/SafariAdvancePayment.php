<?php

namespace App\Models\SafariAdvance;

use App\Models\BaseModel;
use App\Models\Payment\Payment;
use Illuminate\Database\Eloquent\Model;

class SafariAdvancePayment extends BaseModel
{
    //

    public function safari()
    {
        return $this->belongsTo(SafariAdvance::class);
    }
    public  function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
