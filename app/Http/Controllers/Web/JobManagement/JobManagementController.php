<?php

namespace App\Http\Controllers\Web\JobManagement;

use Illuminate\Http\Request;
use App\Models\Unit\Designation;
use HrHireDesignationSkillsTable;
use App\Http\Controllers\Controller;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\HireRequisition\Skill;
use App\Models\HumanResource\HireRequisition\HrHireExperience;
use App\Models\HumanResource\HireRequisition\HrHireDesignationExperience;
use App\Models\HumanResource\HireRequisition\HrHireDesignationSkill;
use App\Repositories\HumanResource\HireRequisition\HireSkillsCategoryRepository;


class JobManagementController extends Controller
{
    private $skillsCategoryRepository,$designationRepository;
    public function __construct()
    {
        $this->skillsCategoryRepository = new HireSkillsCategoryRepository();
        $this->hrHireDesignationSkillsTable = new HrHireDesignationSkillsTable();
        $this->designationRepository = new DesignationRepository();
    }

    public function index()
    {
        return view('HumanResource.JobManagement.index');
    }
    public function settings()
    {
        $skills = Skill::find(1);
        
        $designations = $this->designationRepository->getQueryDesignationUnit()->get();

        // ]);
        // HrHireDesignationCriteria::criteriable();
        return view('HumanResource.JobManagement.Settings.index')->with('designations',$designations);
    }
    public function createSkills()
    {
        $skills = Skill::with('category')->get();
        $skill_categories = $this->skillsCategoryRepository->skillsForSelect();
        return view('HumanResource.JobManagement.Settings.Skills.create')
                ->with('skill_categories',$skill_categories) 
                ->with('skills',$skills);
    }
    
    public function storeSkill(Request $request)
    {
        Skill::create($request->all());
        return redirect()->back();
    }

    public function createExperience()
    {
        $experiences = HrHireExperience::get();
        return view('HumanResource.JobManagement.Settings.Experience.create')
                ->with('experiences',$experiences);
    }
    public function storeExperience(Request $request)
    {
        HrHireExperience::create($request->all());
        return redirect()->back();
    }
    
    public function showDesignation(Designation $designation)
    {
        $skills = Skill::get()->pluck('name','id');
        $experiences = HrHireExperience::get()->pluck('description','id');
        $designation_experiences = HrHireDesignationExperience::select('hr_hire_experiences.description')
            ->join('hr_hire_experiences','hr_hire_experiences.id','hr_hire_designation_experiences.hr_hire_experience_id')
            ->where('designation_id',$designation->id)
            ->get();
        $designation_skills = HrHireDesignationSkill::select('skills.name')
            ->join('skills','skills.id','hr_hire_designation_skills.skill_id')
            ->where('designation_id',$designation->id)
            ->get();
        return view('HumanResource.JobManagement.Settings.designation.show')
                ->with('skills',$skills)
                ->with('experiences',$experiences)
                ->with('designation',$designation)
                ->with('designation_experiences',$designation_experiences)
                ->with('designation_skills',$designation_skills);
    }
    
    public function storeDesignationSkill(Request $request)
    {
      
        $data = $request->all();
        HrHireDesignationSkill::create($data);
        return redirect()->back();
    }
    public function storeDesignationExperience(Request $request)
    {      
        $data = $request->all();
        HrHireDesignationExperience::create($data);
        return redirect()->back();
    }
    

}
