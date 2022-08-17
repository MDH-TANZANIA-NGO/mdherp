<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition\Traits;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\System\WorkingTool;
use App\Models\HumanResource\HireRequisition\Skill;
use App\Models\HumanResource\HireRequisition\SkillCategory;
use App\Models\HumanResource\HireRequisition\HrHireExperience;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionCriteria;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobExperience;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobsCriteriaWeight;

trait HireRequisitionSteps
{
    public function stepGeneral(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 2;
        $job_title = $this->designation->getQueryDesignationUnit()
        ->where('designations.id', $hireRequisitionJob->designation_id)
        ->first();
        $data['hr_requisition_job_id'] = $hireRequisitionJob->id;
        foreach ($request->region as $region) {
            $region_data['hr_requisition_job_id'] = $hireRequisitionJob->id;
            $region_data['region_id'] = $region;
            HireRequisitionLocation::create($region_data);
        }
         $hireRequisitionJob->update($request->except('region', 'files'));
        return view('HumanResource.HireRequisition._parent.form.personal_required')
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('job_title', $job_title)
            ->with('job_title', $job_title)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('uuid', $hireRequisitionJob->uuid);
    }
    public function stepGeneralView(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 2;
        $job_title = $this->designation->getQueryDesignationUnit()
        ->where('designations.id', $hireRequisitionJob->designation_id)
        ->first();
        return view('HumanResource.HireRequisition._parent.form.personal_required')
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            
            ->with('uuid', $hireRequisitionJob->uuid);
    }
    public function stepPersonalRequirement(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 3;
        
        $job_title = $this->designation->getQueryDesignationUnit()
        ->where('designations.id', $hireRequisitionJob->designation_id)
        ->first();
        $current_working_tools = HireRequisitionWorkingTool::select("working_tools.id as id")
                                ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
                                ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $hireRequisitionJob->id)
                                ->pluck('id')->toArray();
        $hireRequisitionJob->update($request->except('region', 'files', 'prospect_for_appointment_cv_id'));
        return view('HumanResource.HireRequisition._parent.form.employment_condition')
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('users', User::where('designation_id', '!=', null)->get())
            ->with('tools', WorkingTool::all())
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('uuid', $hireRequisitionJob->uuid)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('current_working_tools', $current_working_tools) 
            ->with('establishments', code_value()->query()->where('code_id', 9)->get());
    }
    public function stepPersonalRequirementView(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 3;
        $job_title = $this->designation->getQueryDesignationUnit()
        ->where('designations.id', $hireRequisitionJob->designation_id)
        ->first();
        $current_working_tools = HireRequisitionWorkingTool::select("working_tools.id as id")
                                ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
                                ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $hireRequisitionJob->id)
                                ->pluck('id')->toArray();
    
        return view('HumanResource.HireRequisition._parent.form.employment_condition')
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('users', User::where('designation_id', '!=', null)->get())
            ->with('tools', WorkingTool::all())
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('uuid', $hireRequisitionJob->uuid)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('current_working_tools', $current_working_tools) 
            ->with('establishments', code_value()->query()->where('code_id', 9)->get());
    }
    public function stepEmploymentCondition(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 4;
        $job_title = $this->designation->getQueryDesignationUnit()->where('designations.id', $hireRequisitionJob->designation_id)->first();
        $education_level =  code_value()->query()->where('code_id', 10)->get();
        $skillCategories = SkillCategory::get();
        $criterias = HrHireRequisitionCriteria::all();
        $skills = Skill::all();
        $experiences = HrHireExperience::all();
        $criteriaWeights = HrHireRequisitionJobsCriteriaWeight::join('hr_hire_requisitioin_criterias', 'hr_hire_requisitioin_criterias.id', 'hr_hire_requisitioin_job_criteria_weights.hr_hire_requisitioin_job_criteria_id')
                            ->where('hr_requisition_job_id', $hireRequisitionJob->id)
                            ->select('hr_hire_requisitioin_job_criteria_weights.hr_hire_requisitioin_job_criteria_id', 'hr_hire_requisitioin_criterias.id', 'hr_hire_requisitioin_criterias.name', 'hr_hire_requisitioin_job_criteria_weights.weight')->get();
        $_experiences = HrHireRequisitionJobExperience::join('hr_hire_experiences', 'hr_hire_experiences.id', 'hr_hire_requisition_job_experiences.hr_hire_experience_id')
                        ->where('hr_hire_requisition_job_id', $hireRequisitionJob->id)->get();
                       
        $_skills = $this->hireUserSkillsRepository->getQuery()->select('skills.name as name')->join('skills', 'skills.id', 'skill_user.skill_id', 'skills.id')->where('hr_requisition_job_id', $hireRequisitionJob->id)->get();            
        
        if($this->hireRequisitionWorkingToolRepository->query()->where('hire_requisition_job_id',$hireRequisitionJob->id)){

        }else{

        }

        $workingtools = ['tools' => $request->tools, 'hire_requisition_job_id' => $hireRequisitionJob->id];
        // return $workingtools;
        $this->hireRequisitionWorkingToolRepository->store($workingtools);
        $data = $request->except('contract_type','tools');
        $data['hr_contract_type_id'] = $request->contract_type;
        $hireRequisitionJob->update($data);
        return view('HumanResource.HireRequisition._parent.form.criteria')
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('users', User::where('designation_id', '!=', null)->get())
            ->with('tools', WorkingTool::all())
            ->with('uuid', $hireRequisitionJob->uuid)
            ->with('skillCategories', $skillCategories)
            ->with('education_levels', $education_level)
            ->with('criterias', $criterias)
            ->with('experiences', $experiences)
            ->with('skills', $skills) 
            ->with('_skills', $_skills)
            ->with('_experiences', $_experiences)
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('criteriaWeights', $criteriaWeights)
            ->with('establishments', code_value()->query()->where('code_id', 9)->get());
    }
    public function stepEmploymentConditionView(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 4;
       
        $job_title = $this->designation->getQueryDesignationUnit()->where('designations.id', $hireRequisitionJob->designation_id)->first();
        $education_level =  code_value()->query()->where('code_id', 10)->get();
        $skillCategories = SkillCategory::get();
        $criterias = HrHireRequisitionCriteria::all();
        $skills = Skill::all();
        $experiences = HrHireExperience::all();
        $criteriaWeights = HrHireRequisitionJobsCriteriaWeight::join('hr_hire_requisitioin_criterias', 'hr_hire_requisitioin_criterias.id', 'hr_hire_requisitioin_job_criteria_weights.hr_hire_requisitioin_job_criteria_id')
                            ->where('hr_requisition_job_id', $hireRequisitionJob->id)
                            ->select('hr_hire_requisitioin_job_criteria_weights.hr_hire_requisitioin_job_criteria_id', 'hr_hire_requisitioin_criterias.id', 'hr_hire_requisitioin_criterias.name', 'hr_hire_requisitioin_job_criteria_weights.weight')->get();
        $_experiences = HrHireRequisitionJobExperience::join('hr_hire_experiences', 'hr_hire_experiences.id', 'hr_hire_requisition_job_experiences.hr_hire_experience_id')
                        ->where('hr_hire_requisition_job_id', $hireRequisitionJob->id)->get();
                       
        $_skills = $this->hireUserSkillsRepository->getQuery()->select('skills.name as name')->join('skills', 'skills.id', 'skill_user.skill_id', 'skills.id')->where('hr_requisition_job_id', $hireRequisitionJob->id)->get();            
        return view('HumanResource.HireRequisition._parent.form.criteria')
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('users', User::where('designation_id', '!=', null)->get())
            ->with('tools', WorkingTool::all())
            ->with('uuid', $hireRequisitionJob->uuid)
            ->with('skillCategories', $skillCategories)
            ->with('education_levels', $education_level)
            ->with('criterias', $criterias)
            ->with('experiences', $experiences)
            ->with('skills', $skills) 
            ->with('_skills', $_skills)
            ->with('_experiences', $_experiences)
            ->with('step', $step)
            ->with('job_title', $job_title)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('criteriaWeights', $criteriaWeights)
            ->with('establishments', code_value()->query()->where('code_id', 9)->get());
    }
    public function stepCriteria(HireRequisitionJob $hireRequisitionJob, Request $request)
    {

    }
    public function stepReview(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        $step = 5;
        $job_title = $this->designation->getQueryDesignationUnit()
                    ->where('designations.id', $hireRequisitionJob->designation_id)
                    ->first();
        $working_tools = HireRequisitionWorkingTool::select("working_tools.name as name")
            ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
            ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $hireRequisitionJob->id)->get()->implode('name', ',');
        $regions = HireRequisitionLocation::select("regions.name as name")
            ->join('regions', 'regions.id', 'hr_hire_requisition_locations.region_id')
            ->where('hr_hire_requisition_locations.hr_requisition_job_id', $hireRequisitionJob->id)->get()->implode('name', ',');
        $skills =   $this->hireUserSkillsRepository->getQuery()->select('skills.name as name')
            ->join('skills', 'skills.id', 'skill_user.skill_id', 'skills.id')
            ->where('hr_requisition_job_id', $hireRequisitionJob->id)->get();
        $_education_level =  code_value()->query()->where('id', $hireRequisitionJob->education_level)->first();
        // return $_education_level;
        $establishment = code_value()->query()->where('id', $hireRequisitionJob->establishment)->first();
        $hireRequisition = $this->hireRequisitionRepository->find($hireRequisitionJob->hire_requisition_id);
        $appointment_prospect =  code_value()->query()->where('id', $hireRequisitionJob->appointement_prospects_id)->first();
        return view('HumanResource.HireRequisition._parent.form.review')
                ->with('designations', $this->designation->getActiveForSelect())
                ->with('working_tools', $working_tools)
                ->with('regions', $regions)
                ->with('skills', $skills)
                ->with('_education_level', $_education_level)
                ->with('establishment', $establishment)
                ->with('appointment_prospect', $appointment_prospect)
                ->with('step', $step) 
                ->with('job_title', $job_title ) 
                ->with('hireRequisition', $hireRequisition)
                ->with('hireRequisitionJob', $hireRequisitionJob);
    }
    public function addCriteria(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        
        //Education Level
        if ($request->criteria_id == 1) {
            $hireRequisitionJob->update(['education_level' => $request->education_level_id]);
        }

        // Age Limit
        if ($request->criteria_id == 2) {
            $hireRequisitionJob->update($request->except('criteria_id','education_level_id','weight'));
            
        }

        // Skills 
        if ($request->criteria_id == 3) {
            $data = ['skills' => $request->skills, 'hr_requisition_job_id' => $hireRequisitionJob->id];
            $this->hireUserSkillsRepository->store($data);
        }
        // Experience 
        if ($request->criteria_id == 4) {
            foreach ($request->experiences as $experience) {
                $data = ['hr_hire_experience_id' => $experience, 'hr_hire_requisition_job_id' => $hireRequisitionJob->id];
                HrHireRequisitionJobExperience::create($data);
            }
        }

        if ($request->criteria_id == 5) {
            return  $request->criteria_id;
        }

        $data = [
            'hr_requisition_job_id' => $hireRequisitionJob->id,
            'hr_hire_requisitioin_job_criteria_id' =>  $request->criteria_id,
            'weight' =>  $request->weight,
        ];

        $jobCriteria = HrHireRequisitionJobsCriteriaWeight::where('hr_requisition_job_id',$hireRequisitionJob->id)->where('hr_hire_requisitioin_job_criteria_id',$request->criteria_id)->first();
        if($jobCriteria){
            $jobCriteria->update($data);
        }else{
            HrHireRequisitionJobsCriteriaWeight::create($data);
        }
        return redirect()->back();
    }
   

    public function addCriteriaView(HireRequisitionJob $hireRequisitionJob, Request $request)
    {
        return redirect()->back();
    }
   
}
