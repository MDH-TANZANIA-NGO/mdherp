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
        return $this->query();
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
            'fund' => $inputs['fund'],
            'title' => $inputs['title'],
            'code' => $inputs['code']
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
