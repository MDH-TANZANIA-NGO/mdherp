<?php

namespace App\Repositories\Project;

use App\Models\Project\ProgramArea;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProgramAreaRepository extends BaseRepository
{
    const MODEL = ProgramArea::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('program_areas.id AS id'),
            DB::raw('program_areas.title AS title'),
            DB::raw('program_areas.description AS description'),
            DB::raw('program_areas.isactive AS status'),
            DB::raw('program_areas.created_at AS created_at'),
            DB::raw('program_areas.uuid AS uuid'),
            DB::raw('count(projects.id) AS project_count'),
        ])
            ->join('program_area_project','program_area_project.program_area_id','program_areas.id')
            ->join('projects','projects.id','program_area_project.project_id')
            ->groupBy(['program_areas.id','program_areas.title','program_areas.description','program_areas.isactive','program_areas.created_at','program_areas.uuid']);
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
//            'project_id' => $inputs['project'],
            'description' => $inputs['description'],
            'title' => $inputs['title'],
        ];
    }

    /**
     * Store new Program Area
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        return DB::transaction(function () use($inputs){
            $program_area = $this->query()->create($this->inputsProcessor($inputs));
            $program_area->projects()->sync($inputs['projects']);
            return $program_area;
        });
    }

    /**
     * Store new Project
     * @param $inputs
     * @param ProgramArea $programArea
     * @return mixed
     */
    public function update($uuid, $inputs)
    {
        $program_area = $this->findByUuid($uuid);
        return DB::transaction(function () use($inputs, $program_area){
            $program_area->update($this->inputsProcessor($inputs));
            $program_area->projects()->sync($inputs['projects']);
            return $program_area;
        });
    }
}
