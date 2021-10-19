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
            DB::raw('projects.title AS project_title'),
        ])
            ->join('projects','projects.id','program_areas.project_id');
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
            'project_id' => $inputs['project'],
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
            return $this->query()->create($this->inputsProcessor($inputs));
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
            return $program_area->update($this->inputsProcessor($inputs));
        });
    }
}
