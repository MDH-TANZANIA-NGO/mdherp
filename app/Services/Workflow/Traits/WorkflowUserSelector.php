<?php


namespace App\Services\Workflow\Traits;


use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Workflow\UserWfDefinition;
use App\Models\Workflow\WfDefinition;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Workflow\WfDefinitionRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Access\UserRepository;

trait WorkflowUserSelector
{
//    public function nextUserSelector($wf_definition_id, $region_id)
//    {
//        $user_id = null;
//        $user_wf_definition = UserWfDefinition::query()
//            ->select(["user_id", DB::raw("max(id)")])
//            ->where('wf_definition_id',$wf_definition_id)
//            ->groupBy('user_id');
//        if  ($user_wf_definition->count()){
//            foreach ($user_wf_definition->get() as $result){
//                $user = User::query()->where('id',$result->user_id)->where('region_id',$region_id);
//                if($user->count()){
//                    $user_id = $user->first()->id;
//                }
//            }
//        }
//
//        return $user_id;
//    }

    public function nextUserSelector($wf_module_id,$resource_id,$level,$department_id=null)
    {
        $user_id = null;

        switch ($wf_module_id)
        {
            case 1:
                $requisition_repo = (new RequisitionRepository());
                $requisition = $requisition_repo->find($resource_id);
                /*check levels*/
                switch ($level){
                    case 1:
                        $next_user = $requisition->activity->subProgram->users()->first();
                        if(!$next_user){
                            throw new GeneralException('Sub Program Area Manager not assigned');
                        }
                        $user_id = $next_user->id;
                        break;

                    case 2:
                        $next_user = $requisition->project->users()
                            ->where('users.region_id', $requisition->region_id)
                            ->where('users.designation_id', 82)
                            ->where('users.active',true)
                            ->orderBy('id','DESC')
                            ->first();
                        if(!$next_user){
                            throw new GeneralException('Regional Project Manager not assigned');
                        }
                        $user_id = $next_user->id;
                        break;

                    case 3:
                        $next_user = (new WfDefinitionRepository())->getUser($wf_module_id, 4);
                        if(!$next_user){
                            throw new GeneralException('Deputy Director not assigned');
                        }
                        $user_id = $next_user->id;
                        break;

                    case 4:
                        $next_user = (new UserRepository())->getDirectorOfDepartment($department_id);
                        if($next_user->count() == 0){
                            throw new GeneralException('Director of Department is not yet registered. Please contact system administrator');
                        }
                        $user_id = $next_user->first()->user_id;
                        break;
                }
                break;
        }

        return $user_id;
    }



}
