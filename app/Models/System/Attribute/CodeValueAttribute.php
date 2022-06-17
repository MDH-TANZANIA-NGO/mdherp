<?php

namespace App\Models\System\Attribute;

use App\Repositories\Business\OfferRepository;
use App\Repositories\Business\TenderRepository;
use Carbon\Carbon;

trait CodeValueAttribute
{

    /*Get count of pending tenders per logistic service type (Tender which still allow bidding)*/
    public function getTendersPendingCountAttribute()
    {
        $tenders = new TenderRepository();
        return $tenders->queryFilterForTenderSearch()->whereHas('logisticService', function($query) {
            $query->where('logistic_service_cv_id', $this->id);
        })->count();
    }

    /*Get name with tender pending - Tenders which still allow bidding/applications*/
    public function getNameWithTendersPendingCountAttribute()
    {
        return __('code_value.'. $this->id) . ' (' . number_0_format($this->getTendersPendingCountAttribute()) . ')';
    }



    /*Get count of pending offers per logistic service type (Offers which still allow bidding)*/
    public function getOffersPendingCountAttribute()
    {
        $tenders = new OfferRepository();
        return $tenders->queryFilterForOfferSearch()->whereHas('logisticService', function($query) {
            $query->where('logistic_service_cv_id', $this->id);
        })->count();
    }

    /*Get name with offer pending - Offers which still allow applications*/
    public function getNameWithOffersPendingCountAttribute()
    {
        return __('code_value.'. $this->id) . ' (' . number_0_format($this->getOffersPendingCountAttribute()) . ')';
    }


}