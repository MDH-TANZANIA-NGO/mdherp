<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:53 AM
 */

namespace App\Repositories\Unit;


use App\Models\Unit\Designation;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DesignationRepository extends BaseRepository
{
    const MODEL = Designation::class;

    public function getQuery()
    {
        return $this->query();
    }

    public function getQueryDesignationUnit()
    {
        return $this->query()->select([
            DB::raw('designations.id'),
            DB::raw("concat_ws(' ', units.name, designations.name) as name"),

            DB::raw("units.id AS unit_id")
        ])
            ->join('units', 'units.id', 'designations.unit_id');
    }

    public function getDesignationById($id)
    {
        $a = $this->getQueryDesignationUnit()->where('designations.id', $id);
        return $a->count() > 0 ? $a->first()->name : '';
//        return $this->getQueryDesignationUnit()->where('designations.id', $id)->first();
    }

    public function getActive()
    {
        return $this->getQuery()->where('isactive', 1);
    }

    public function getActiveForSelect()
    {
        return $this->getQueryDesignationUnit()
            ->where('designations.isactive', 1)
            ->orderBy('units.name', 'ASC')
            ->pluck('name', 'id');
    }
}
