<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrAttributeAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrAttributeRelationship;
use Illuminate\Database\Eloquent\Model;

class PrAttribute extends Model
{
    use PrAttributeAttribute, PrAttributeRelationship;
}
