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
            DB::raw("concat_ws(' : ',activities.code, activities.description )AS code_title"),
            DB::raw('activities.uuid AS uuid'),
            DB::raw('output_units.title AS output_unit_title'),
            DB::raw('sub_programs.title AS sub_program_title'),
            DB::raw('program_areas.title AS program_area_title'),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
        ])
            ->join('output_units','output_units.id','activities.output_unit_id')
            ->join('sub_programs','sub_programs.id', 'activities.sub_program_id')
            ->join('program_areas','program_areas.id','sub_programs.program_area_id')
            ->join('program_area_project','program_area_project.program_area_id','program_areas.id')
            ->join('projects','projects.id','program_area_project.project_id')
            ->groupBy('activities.id','activities.code','activities.title','activities.description','activities.uuid','output_units.title','program_areas.title','sub_programs.title');
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
            'sub_program_id' => $inputs['sub_program'],
            'description' => $inputs['description'],
            'title' => $inputs['title'],
            'code' => $inputs['code'],
            'output_unit_id' => $inputs['output_unit'],
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

    public function getQueryTwo()
    {
        return $this->query()->select([
            DB::raw('activities.id AS id'),
            DB::raw('activities.code AS code'),
            DB::raw('activities.title AS title'),
            DB::raw('activities.description AS description'),
            DB::raw("concat_ws(' : ',activities.code, activities.description )AS code_title"),
            DB::raw('activities.uuid AS uuid'),
            DB::raw('output_units.title AS output_unit_title'),
            DB::raw('sub_programs.title AS sub_program_title'),
            DB::raw('program_areas.title AS program_area_title'),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
            DB::raw('budgets.numeric_output AS numeric_output'),
            DB::raw('budgets.amount AS budget_amount'),
            DB::raw('budgets.actual_amount AS budget_actual_amount'),
            DB::raw('budgets.id AS budget_id'),
            DB::raw('budgets.rate_id AS rate_id'),
        ])
            ->join('output_units','output_units.id','activities.output_unit_id')
            ->join('sub_programs','sub_programs.id', 'activities.sub_program_id')
            ->join('program_areas','program_areas.id','sub_programs.program_area_id')
            ->join('program_area_project','program_area_project.program_area_id','program_areas.id')
            ->join('projects','projects.id','program_area_project.project_id')
            ->join('budgets','budgets.activity_id','activities.id')
            ->join('fiscal_years','fiscal_years.id','budgets.fiscal_year_id')
            ->groupBy('activities.id','activities.code','activities.title','activities.description',
                'activities.uuid','output_units.title','program_areas.title','sub_programs.title','budgets.numeric_output','budgets.amount','budgets.id');
    }

    public function getSubQuery($activity_id, $project_id, $region_id)
    {
        return $this->getQueryTwo()
            ->join('project_region','project_region.project_id','projects.id')
            ->join('regions','regions.id','project_region.region_id')
            ->where('budgets.active', true)
            ->where('regions.id', $region_id)
            ->where('projects.id',$project_id)
            ->where('activities.id', $activity_id)
            ->get();
    }

    public function getActivities($user_id, $region_id, $project_id)
    {
        return $this->getQuery()
            ->join('project_user','project_user.project_id','projects.id')
            ->join('users','users.id','project_user.user_id')
            ->join('project_region','project_region.project_id','projects.id')
            ->join('regions','regions.id','project_region.region_id')
            ->where('users.id', $user_id)
            ->where('regions.id', $region_id)
            ->where('projects.id',$project_id)
            ->get();
    }
}
