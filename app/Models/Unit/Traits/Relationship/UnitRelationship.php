<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:45 AM
 */

namespace App\Models\Unit\Traits\Relationship;


use App\Models\Payment\Payment;
use App\Models\Unit\Account;

trait UnitRelationship
{
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
