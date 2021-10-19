<?php

namespace App\Repositories\Project;

use App\Models\Project\Project;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends BaseRepository
{
    const MODEL = Project::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('projects.code AS code'),
            DB::raw('projects.title AS title'),
            DB::raw('projects.description AS description'),
            DB::raw('projects.start_year AS start_year'),
            DB::raw('projects.end_year AS end_year'),
            DB::raw('projects.isactive AS status'),
            DB::raw('code_values.name AS type'),
            DB::raw('projects.uuid AS uuid'),
            DB::raw('projects.created_at AS created_at'),
        ])
            ->join('code_values','code_values.id','projects.project_type_cv_id');
    }

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
            return $this->query()->create($this->inputsProcessor($inputs));
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
            return $project->update($this->inputsProcessor($inputs));
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
}
