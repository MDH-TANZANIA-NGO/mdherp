<?php

namespace App\Models\System\Relationship;

use App\Models\Auth\User;
use App\Models\Business\Commodity;
use App\Models\Business\Tender;
use App\Models\Business\TenderTran;
use App\Models\Information\Legislation;
use App\Models\Information\News;
use App\Models\Stakeholder\Company;
use App\Models\System\Code;
use App\Models\System\CodeValue;
use App\Models\System\RoleCharge;

trait CodeValueRelationship
{

    /*Relation of association to company*/
    public function associationCompanies(){
        return $this->belongsToMany(Company::class, 'company_association', 'logistic_association_cv_id', 'company_id');
    }


    public function code()
    {
        return $this->belongsTo(Code::class);
    }


    public function codes(){
        return $this->belongsToMany(Code::class, 'code_value_code', 'code_value_id', 'code_id');
    }

    public function news(){
        return  $this->belongsToMany(News::class, 'logistic_service_cv_id', 'id');
    }

    public function roleCharges()
    {
        return $this->hasMany(RoleCharge::class, "payment_period_cv_id")->orderBy("role_id", "asc");
    }

    /*Relation to tenders for Logistic service types*/
    public function tenders()
    {
        return $this->hasMany(Tender::class, "logistic_service_cv_id");
    }

    /*Relation to tenderTrans on carriage category*/
    public function carriageCategoryTenderTrans()
    {
        return $this->hasMany(TenderTran::class, "carriage_category_cv_id");
    }

    public function commodityCategory()
    {
        return $this->hasMany(Commodity::class, 'commodity_category_cv_id');
    }

    public function legislationAuthority()
    {
        return $this->hasMany(Legislation::class, 'authority_cv_id');
    }

    public function legislationLogisticService()
    {
        return $this->hasMany(Legislation::class, 'logistic_service_cv_id');
    }

    public function legislationLogisticServiceSub()
    {
        return $this->hasMany(Legislation::class, 'logistic_service_sub_cv_id');
    }
}