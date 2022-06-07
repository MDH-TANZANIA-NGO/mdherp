<?php


namespace App\Services\Workflow\Traits;


use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Unit\Designation;
use App\Models\Workflow\UserWfDefinition;
use App\Models\Workflow\WfDefinition;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\Leave\LeaveRepository;
use App\Repositories\Listing\ListingRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\Timesheet\TimesheetRepository;
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

                        case 5:
                        $next_user = (new UserRepository())->getCeo();
                        if($next_user->count() == 0){
                            throw new GeneralException('CEO is not yet registered. Please contact system administrator');
                        }
                        $user_id = $next_user->first()->user_id;
                        break;
                }
                break;
            case 3:
                $safari_advance_repo = (new SafariAdvanceRepository());
                $safari = $safari_advance_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $next_user = $safari->user->assignedSupervisor();
                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                }
                break;
            case 4:
                $program_activity_repo = (new ProgramActivityRepository());
                $program_activity = $program_activity_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
//                        dd($program_activity->user->assignedSupervisor());
                        $next_user = $program_activity->user->assignedSupervisor();

                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                }
                break;
            case 5:
                $retirement_repo = (new RetirementRepository());
                $retirement = $retirement_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $next_user = $retirement->user->assignedSupervisor();
                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                }
                break;
            case 6:
                $leave_repo = (new LeaveRepository());
                $leave = $leave_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $next_user = $leave->user->assignedSupervisor();
                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                    case 2:
                        $next_user = User::query()
                            ->where('users.region_id', $leave->region_id)
                            ->where('users.designation_id', 82)
                            ->where('users.active',true)
                            ->orderBy('id','DESC')
                            ->first();

                        if (!$next_user) {
                            throw new GeneralException('There is no assigned RPM');
                        }
                        $user_id = $next_user->id;
                        break;
                    case 3:
                        $user_dept = $leave->user->designation->department->id;
                        $next_user = (new UserRepository())->getDirectorOfDepartment($user_dept)->first();
                        //dd($next_user);
                        if (!$next_user) {
                            throw new GeneralException('There is no assigned director');
                        }
                        $user_id = $next_user->user_id;
                        break;
                    case 4:
                        $next_user = User::query()
                            ->where('users.designation_id', 8)
                            ->where('users.active',true)
                            ->orderBy('id','DESC')
                            ->first();
                        if (!$next_user) {
                            throw new GeneralException('Director of Human Resource is not assigned');
                        }
                        $user_id = $next_user->id;
                        break;
                    case 5:
                        $next_user = User::query()
                            ->where('users.designation_id', 13)
                            ->where('users.active',true)
                            ->orderBy('id','DESC')
                            ->first();
                        if (!$next_user) {
                            throw new GeneralException('CEO is not assigned');
                        }
                        $user_id = $next_user->id;
                        break;
                }
                break;
            case 7:
                $finance_repo = (new FinanceActivityRepository());
                $payment = $finance_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $next_user = $payment->user->assignedSupervisor();
                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                }
                break;
            case 8:
                $timesheet_repo = (new TimesheetRepository());
                $timesheet = $timesheet_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $next_user = $timesheet->user->assignedSupervisor();
                        if (!$next_user) {
                            throw new GeneralException('This user has not assigned supervisor');
                        }
                        $user_id = $next_user->supervisor_id;
                        break;
                }
                break;
            case 9:
                $listing_repo = (new ListingRepository());
                $listing = $listing_repo->find($resource_id);
                /*check levels*/
                switch ($level) {
                    case 1:
                        $user_dept = $listing->user->designation->department->id;
                        $next_user = (new UserRepository())->getDirectorOfDepartment($user_dept)->get();
                        if (!$next_user) {
                            throw new GeneralException('Director of Department is not yet registered. Please contact system administrator');
                        }
                        $user_id = $next_user->first()->user_id;
                        break;
                    case 2:
                        $next_user = (new UserRepository())->getDirectorOfHR();;
                        if (!$next_user) {
                            throw new GeneralException('Director of HR is not yet registered. Please contact system Admin');
                        }
                        $user_id = $next_user->user_id;
                        break;

                    case 3:
                        $next_user = (new UserRepository())->getCEO2();
                        if (!$next_user) {
                            throw new GeneralException('CEO is not yet registered. Please contact system administrator');
                        }
                        $user_id = $next_user->user_id;
                        break;
                }
                break;
        }

        return $user_id;
    }



}
