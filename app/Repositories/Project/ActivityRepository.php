<?php

namespace App\Repositories\Project;

use App\Models\Project\Activity;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ActivityRepository extends BaseRepository
{
    const MODEL = Activity::class;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('activities.id AS id'),
            DB::raw('activities.code AS code'),
            DB::raw('activities.title AS title'),
            DB::raw('activities.description AS description'),
            DB::raw('activities.uuid AS uuid'),
            DB::raw('projects.title AS project_title'),
            DB::raw('program_areas.title AS program_area_title'),
        ])
            ->join('program_areas','program_areas.id','activities.program_area_id')
            ->join('projects','projects.id','program_areas.project_id');
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->getQuery();
    }

    /**
     * Inputs Processor
     * @param $inputs
     * @return array
     */
    public function inputsProcessor($inputs)
    {
        return [
            'program_area_id' => $inputs['program_area'],
            'description' => $inputs['description'],
            'title' => $inputs['title'],
            'code' => $inputs['code'],
        ];
    }

    /**
     * Store new Activity
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use($inputs){
            return $this->query()->create($this->inputsProcessor($inputs));
        });
    }

    /**
     * Store new Activity
     * @param Activity $activity
     * @param $inputs
     * @return mixed
     */
    public function update(Activity $activity, $inputs)
    {
        return DB::transaction(function () use($activity, $inputs){
            return $activity->update($this->inputsProcessor($inputs));
        });
    }
}
