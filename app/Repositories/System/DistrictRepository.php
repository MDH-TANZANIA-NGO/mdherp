<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/30/19
 * Time: 11:38 AM
 */

namespace App\Repositories\System;


use App\Models\System\District;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistrictRepository extends BaseRepository
{
    const MODEL = District::class;

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
    public function getForPluck()
    {
        return $this->query()->orderBy('name','asc')->pluck('name', 'id');
    }

    /**
     * @param $region_id
     * @return mixed
     */
    public function getByRegion($region_id)
    {
        return $this->query()->where('region_id', $region_id);
    }

    /**
     * @param $region_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getForPluckFilterByRegion($region_id)
    {
        $data = $this->query()->where('region_id',$region_id)->orderBy('name','asc')->get(['name','id']);
        return response()->json(['districts' => $data]);
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('districts.id AS id'),
            DB::raw('districts.name AS name'),
//            DB::raw('districts.separate_id AS separate_id'),
            DB::raw('regions.name AS region_name'),
//            DB::raw('code_values.name as code_name'),
        ])
            ->join('regions', 'regions.id', 'districts.region_id');
//            ->leftjoin('separates', 'separates.id', 'districts.separate_id')
//            ->leftjoin('code_values', 'code_values.id', 'separates.separate_cv_id');
    }

    /**
     * Get Active districts
     * @return mixed
     */
    public function getActive()
    {
        return $this->getQuery()
//            ->whereNotNull('districts.separate_id')
            ->orderBy('name', 'ASC');
    }


    public function getForExceptional($region_id)
    {
        return $this->getQuery()
            ->where('regions.id', $region_id);
    }

    /**
     * Update Separate
     * @param District $district
     * @param $inputs
     * @return mixed
     */
    public function updateSeparate(District $district, $inputs)
    {
        return DB::transaction(function () use ($district, $inputs){
            return $district->update(['separate_id' => $inputs['separate']]);
        });
    }

    public function getAllByTber()
    {
        return $this->getQuery()
            ->join('trips', 'trips.district_id', 'districts.id')
            ->join('tafs', 'tafs.id', 'trips.taf_id')
            ->join('tbers', 'tbers.taf_id', 'tafs.id');
    }

    public function getAllByTaf()
    {
        return $this->getQuery()
            ->join('trips', 'trips.district_id', 'districts.id')
            ->join('tafs', 'tafs.id', 'trips.taf_id');
    }

    public function getDistrictByTaf($tber)
    {
        return $tber->count() ? $this->getAllByTaf()->where('tafs.id', $tber->first()->taf_id)->pluck('name', 'id') :
            $this->getAllByTaf()->pluck('name', 'id');
    }

    public function allPluck()
    {
        return $this->getActive()->pluck('name', 'id');
    }
public function getFacilitiesByDistrict($id)
{
    return $this->query()
        ->addSelect([
            'facilities.id AS facility_id',
            'facilities.name As facility_name',

        ])
        ->join('wards','wards.district_id','districts.id')
        ->join('facilities','facilities.ward_id','wards.id')
        ->where('districts.id',$id);
}


}
