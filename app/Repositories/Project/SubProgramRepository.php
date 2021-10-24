<?php

namespace App\Repositories\Project;

use App\Models\Project\Activity;
use App\Models\Project\SubProgram;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SubProgramRepository extends BaseRepository
{
    const MODEL = SubProgram::class;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('sub_programs.id AS id'),
            DB::raw('sub_programs.title AS title'),
            DB::raw('sub_programs.description AS description'),
            DB::raw('sub_programs.uuid AS uuid'),
            DB::raw('program_areas.title AS program_area_title'),
            DB::raw("string_agg(DISTINCT projects.title, ',') as project_list"),
        ])
            ->join('program_areas','program_areas.id','sub_programs.program_area_id')
            ->join('program_area_project','program_area_project.program_area_id','program_areas.id')
            ->join('projects','projects.id','program_area_project.project_id')
            ->groupBy('sub_programs.id','sub_programs.title','sub_programs.description','sub_programs.uuid','program_areas.title');
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
     * @param SubProgram $subProgram
     * @param $inputs
     * @return mixed
     */
    public function update(SubProgram $subProgram, $inputs)
    {
        return DB::transaction(function () use($subProgram, $inputs){
            return $subProgram->update($this->inputsProcessor($inputs));
        });
    }
}
