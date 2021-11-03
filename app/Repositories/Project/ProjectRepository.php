<?php

namespace App\Repositories\Project;

use App\Models\Project\Project;
use App\Models\Project\ProjectRegion;
use App\Models\System\Region;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends BaseRepository
{
    const MODEL = Project::class;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('projects.id AS id'),
            DB::raw('projects.code AS code'),
            DB::raw('projects.title AS title'),
            DB::raw('projects.description AS description'),
            DB::raw('projects.start_year AS start_year'),
            DB::raw('projects.end_year AS end_year'),
            DB::raw('projects.isactive AS status'),
            DB::raw('code_values.name AS type'),
            DB::raw('code_values.id AS type_id'),
            DB::raw('projects.uuid AS uuid'),
            DB::raw('projects.created_at AS created_at'),
            DB::raw("string_agg(DISTINCT regions.name, ',') AS regions_count")
        ])
            ->join('code_values','code_values.id','projects.project_type_cv_id')
            ->leftjoin('project_region','project_region.project_id','projects.id')
            ->leftjoin('regions','regions.id', 'project_region.id')
            ->groupBy([
                'projects.id',
                'projects.code',
                'projects.description',
                'projects.start_year',
                'projects.end_year',
                'projects.isactive',
                'code_values.name',
                'code_values.id',
                'projects.uuid',
                'projects.created_at',
            ]);
    }

    /**
     * Get All Active Projects
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
            'end_year' => $inputs['end_year'],
            'start_year' => $inputs['start_year'],
            'description' => $inputs['description'],
//            'fund' => $inputs['fund'],
            'title' => $inputs['title'],
            'code' => $inputs['code'],
            'project_type_cv_id' => $inputs['type'],
        ];
    }

    /**
     * Store new Project
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use($inputs){
            $project = $this->query()->create($this->inputsProcessor($inputs));
            if(isset($inputs['regions']))
            $project->regions()->sync($inputs['regions']);
            return $project;
        });
    }

    /**
     * Store new Project
     * @param $inputs
     * @param Project $project
     * @return mixed
     */
    public function update($inputs, Project $project)
    {
        return DB::transaction(function () use($inputs, $project){
            $project->update($this->inputsProcessor($inputs));
            if(isset($inputs['regions']))
                $project->regions()->sync($inputs['regions']);
            return $project;
        });
    }

    /**
     * Activate or di-activate project
     * @param $inputs
     * @param Project $project
     * @return mixed
     */
    public function activate($inputs, Project $project)
    {
        return DB::transaction(function () use ($inputs, $project){
            return $project->update(['isactive' => $inputs['activate']]);
        });
    }

    public function getByRegion($region_id)
    {
        return $this->query()->select([
            'projects.id AS id',
            'projects.title AS title'
        ])
            ->leftjoin('project_region','project_region.project_id','projects.id')
            ->leftjoin('regions','regions.id','project_region.region_id')
            ->where('regions.id', $region_id)
            ->get();
    }

    public function getUserProjects($user_id)
    {
        return $this->query()->select([
            'projects.id AS id',
            'projects.title AS title'
        ])
            ->leftjoin('project_user','project_user.project_id','projects.id')
            ->leftjoin('users','users.id','project_user.user_id')
            ->where('users.id', $user_id)
            ->get();
    }

}
