<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrTypeAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrTypeRelationship;
use Illuminate\Database\Eloquent\Model;

class PrType extends Model
{
    use PrTypeAttribute, PrTypeRelationship;
}
