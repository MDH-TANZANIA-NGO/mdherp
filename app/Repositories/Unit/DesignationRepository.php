<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:53 AM
 */

namespace App\Repositories\Unit;

use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
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

    public function getNewStaffDesignations(){
        return $this->query()->select([
            DB::raw('designations.id'),
            DB::raw("concat_ws(' ', units.name, designations.name) as name"),
            DB::raw("units.id AS unit_id")
        ])
            ->join('units', 'units.id', 'designations.unit_id')
            ->join('users', 'users.designation_id', 'designations.id')
            ->where('users.user_account_cv_id', 48)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
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
    public function getActiveAdvertisedForSelect()
    {
        $today = date('Y-m-d');
        return $this->query()->select(
                    [
                        DB::raw("concat_ws(' ', units.name, designations.name) as name"),
                        DB::raw('hr_hire_requisitions_jobs.id as hr_hire_requisition_job_id'),
                        DB::raw('hr_hire_advertisement_requisitions.dead_line as dead_line'),
                    ]
            )
            ->join('hr_hire_requisitions_jobs','designations.id','hr_hire_requisitions_jobs.designation_id')
            ->join('hr_hire_advertisement_requisitions','hr_hire_requisitions_jobs.id','hr_hire_advertisement_requisitions.hire_requisition_job_id')
            ->join('units', 'units.id', 'designations.unit_id')
            ->where('hr_hire_requisitions_jobs.is_advertised', 1)
            // ->where('hr_hire_advertisement_requisitions.dead_line',">",$today )
            ->orderBy('name', 'ASC')
            ->pluck('name', 'hr_hire_requisition_job_id');
    }

}
