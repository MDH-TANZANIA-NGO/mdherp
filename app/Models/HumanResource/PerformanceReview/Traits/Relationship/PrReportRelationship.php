<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\HumanResource\PerformanceReview\PrAchievementComment;
use App\Models\HumanResource\PerformanceReview\PrAttributeRate;
use App\Models\HumanResource\PerformanceReview\PrCompetence;
use App\Models\HumanResource\PerformanceReview\PrEducationOpportunity;
use App\Models\HumanResource\PerformanceReview\PrNextObjective;
use App\Models\HumanResource\PerformanceReview\PrObjective;
use App\Models\HumanResource\PerformanceReview\PrRecommendation;
use App\Models\HumanResource\PerformanceReview\PrRemark;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Models\HumanResource\PerformanceReview\PrSkill;
use App\Models\HumanResource\PerformanceReview\PrType;
use App\Models\Workflow\WfTrack;

trait PrReportRelationship
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function type()
    {
        return $this->belongsTo(PrType::class,'pr_type_id','id');
    }

    public function objectives()
    {
        return $this->hasMany(PrObjective::class)->orderBy('id');
    }

    public function attributeRates()
    {
        return $this->hasMany(PrAttributeRate::class)->orderBy('pr_rate_scale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function child()
    {
        return $this->hasOne(PrReport::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(PrReport::class, 'parent_id');
    }

    public function competences()
    {
        return $this->hasMany(PrCompetence::class,'pr_report_id','id')->orderBy('id');
    }

    public function remarks()
    {
        return $this->hasMany(PrRemark::class, 'pr_report_id','id')->orderBy('id');
    }

    public function skill()
    {
        return $this->hasOne(PrSkill::class,'pr_report_id', 'id');
    }

    public function education()
    {
        return $this->hasOne(PrEducationOpportunity::class,'pr_report_id','id');
    }

    public function nextObjectives()
    {
        return $this->hasMany(PrNextObjective::class, 'pr_report_id','id');
    }

    public function achievementComment()
    {
        return $this->hasOne(PrAchievementComment::class, 'pr_report_id','id');
    }

    public function recommendation()
    {
        return $this->hasOne(PrRecommendation::class,'pr_report_id','id');
    }

}
