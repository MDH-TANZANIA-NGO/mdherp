<?php


namespace App\Repositories\Access;


use App\Models\Auth\SupervisorUser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SupervisorUserRepository extends BaseRepository
{
    const MODEL = SupervisorUser::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('users.uni as uni'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as names"),
            DB::raw("concat_ws(' ', units.name, designations.name) as title"),
            DB::raw('regions.name as region')
        ])
            ->join('users', 'users.id', 'supervisor_users.user_id')
            ->join('regions', 'regions.id', 'users.region_id')
            ->join('designations', 'designations.id', 'users.designation_id')
            ->join('units','units.id', 'designations.unit_id');
    }

    public function getAccessSupervisionForDatatables()
    {
        return $this->getQuery()->where('supervisor_users.supervisor_id', access()->id());
    }

    public function updateSupervisor($inputs){

        $supervisor_id = $inputs['user'];

        return DB::transaction(function() use($supervisor_id){
            return $this->query()->where('supervisor_id', access()->id())
                        ->update(['supervisor_id' => $supervisor_id]);
        });
    }
}
