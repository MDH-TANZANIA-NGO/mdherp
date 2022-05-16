<?php

namespace App\Repositories\System;

use App\Models\Auth\User;
use App\Models\System\Region;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegionRepository extends BaseRepository
{
    const MODEL = Region::class;

    public function getRegionByCode($hasc)
    {
        $region = $this->query()->where('hasc', $hasc)->first();
            return $region;
    }

    public function getRegionById($id)
    {
        $region = $this->query()->where('id', $id)->first();
        return $region;
    }

    /**
     * @param array $input
     * @return mixed
     * Regex column search
     */
    public function regexColumnSearch(array $input)
    {
        $return = $this->query();
        if ($input) {
            $sql = $this->regexFormatColumn($input)['sql'];
            $keyword = $this->regexFormatColumn($input)['keyword'];
            $return = $this->query()->whereRaw($sql, $keyword);
        }
        return $return;
    }

    /**
     * @param $q
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     * Get registered companies for select
     */
    public function getForSelect($q, $page)
    {
        $resultCount = 15;
        $offset = ($page - 1) * $resultCount;
        $data['items'] = $this->regexColumnSearch(['name' => $q])->limit($resultCount)->offset($offset)->get()->toArray();
        $data['total_count'] = count($data['items']);
        return response()->json($data);
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('regions.id'),
            DB::raw('regions.name'),
            DB::raw('COUNT(districts.id) as districts_count'),
        ])
            ->join('districts','districts.region_id','regions.id')
            ->groupBy([
                'regions.id',
                'regions.name',
            ]);
    }

    public function getExceptional()
    {
        return $this->getQuery()
            ->where('regions.exceptional', true);
    }

    public function forOfficeSelect()
    {
        return $this->query()
            ->where('isactive', 1)
            ->whereNotIn('id', User::query()->select('region_id')->where('user_account_cv_id',config('icap.office_cvid'))->pluck('region_id'))
            ->pluck('name', 'id');
    }

    public function getByActivity($activity_id)
    {
        return $this->query()->select([
            DB::raw('regions.id AS id'),
            DB::raw('regions.name AS name'),
            DB::raw('projects.project_type_cv_id AS project_type'),
        ])
            ->join('project_region','project_region.region_id','regions.id')
            ->join('projects','projects.id', 'project_region.project_id')
            ->join('program_area_project', 'program_area_project.project_id','projects.id')
            ->join('program_areas','program_areas.id','program_area_project.program_area_id')
            ->join('sub_programs','sub_programs.program_area_id','program_areas.id')
            ->join('activities','activities.sub_program_id','sub_programs.id')
            ->groupBy('regions.id','regions.name','projects.project_type_cv_id')
            ->where('activities.id',$activity_id)
            ->get();
    }



}
