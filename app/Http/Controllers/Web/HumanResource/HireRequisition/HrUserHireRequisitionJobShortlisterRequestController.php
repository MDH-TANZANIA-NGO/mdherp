<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobRequest;
use App\Repositories\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequestRepository;

class HrUserHireRequisitionJobShortlisterRequestController extends Controller
{
    protected $hr_user_hire_requisition_job_shortlister_requests;

    public function __construct()
    {
        $this->hr_user_hire_requisition_job_shortlister_requests = (new HrUserHireRequisitionJobShortlisterRequestRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function initiate(HrUserHireRequisitionJobRequest $hr_user_hire_requisition_job_shortlister_request)
    {
        return view('shortlister.initiate')
        ->with('shortlister_request',$hr_user_hire_requisition_job_shortlister_request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hr_user_hire_requisition_job_shortlisters =$this->hr_user_hire_requisition_job_shortlisters->store($request->all());
        alert()->success('Shortlister Added Successfully');
        return redirect()->route('job_shortlister.initiate',$hr_user_hire_requisition_job_shortlisters);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
