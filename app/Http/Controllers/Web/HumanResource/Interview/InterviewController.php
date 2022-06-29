<?php

namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use  App\Http\Controllers\Web\HumanResource\Interview\Traits\InterviewDatatable;
use App\Http\Controllers\Controller;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\InterviewTypes;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\Interview\InterviewRepository;

class InterviewController extends Controller
{

    public $designationRepository;
    public $interviewRepository;
    public $userRepository;

    use InterviewDatatable;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New InterviewRepository());
        $this->userRepository = (New UserRepository());

    } 

    public function index(){
         
    }


    public function create(){
        $designations = $this->designationRepository->getActiveForSelect();
        $interview_types = InterviewTypes::get() ->pluck('name', 'id');
        return view('HumanResource.Interview.create')
                ->with('designations',$designations)
                ->with('interview_types',$interview_types);
    }
    public function store(Request $request){
        $interview = $this->interviewRepository->store($request->all());
        $users = $this->userRepository->forSelect();
        alert()->success('initiated Successfully');
        return view('HumanResource.Interview.saved')
                ->with('interview',$interview)
                ->with('users',$users);

    }

    public function initiate(){

    }
}
