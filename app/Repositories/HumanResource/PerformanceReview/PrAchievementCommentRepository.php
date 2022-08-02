<?php

namespace App\Repositories\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\PrAchievementComment;
use App\Models\HumanResource\PerformanceReview\PrReport;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PrAchievementCommentRepository extends BaseRepository
{
    const MODEL = PrAchievementComment::class;

    public function store(PrReport $pr_report, $input)
    {
        return DB::transaction(function() use($pr_report, $input){
            return $pr_report->achievementComment()->create($input);
        });
    }

    public function update(PrAchievementComment $pr_achievement_comment, $input)
    {
        return DB::transaction(function() use($pr_achievement_comment, $input){
            return $pr_achievement_comment->update($input);
        });
    }
}