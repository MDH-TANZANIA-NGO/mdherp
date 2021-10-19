<?php

namespace App\Repositories\Project;

use App\Models\Project\ProgramArea;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProgramAreaRepository extends BaseRepository
{
    const MODEL = ProgramArea::class;

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
    public function update($inputs, ProgramArea $programArea)
    {
        return DB::transaction(function () use($inputs, $programArea){
            return $programArea->update($this->inputsProcessor($inputs));
        });
    }
}
