<?php


namespace App\Services\Workflow\Traits;


use App\Models\Auth\User;
use App\Models\Workflow\UserWfDefinition;
use Illuminate\Support\Facades\DB;

trait WorkflowUserSelector
{

    public function nextUserSelector($wf_definition_id, $region_id)
    {
        $user_id = null;
        $user_wf_definition = UserWfDefinition::query()
            ->select(["user_id", DB::raw("max(id)")])
            ->where('wf_definition_id',$wf_definition_id)
            ->groupBy('user_id');
        if  ($user_wf_definition->count()){
            foreach ($user_wf_definition->get() as $result){
                $user = User::query()->where('id',$result->user_id)->where('region_id',$region_id);
                if($user->count()){
                    $user_id = $user->first()->id;
                }
            }
        }

        return $user_id;
    }

}
