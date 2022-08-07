<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobApplicantShortlisterRepository;
use Illuminate\Http\Request;

class HrHireRequisitionJobApplicantShortlisterController extends Controller
{
    protected $hr_applicant_shortlists;

    public function __construct()
    {
        $this->hr_applicant_shortlists = (new HrHireRequisitionJobApplicantShortlisterRepository());
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shortlist(Request $request, HireRequisitionJob $hire_requisition_job)
    {
        $this->hr_applicant_shortlists->shortlist($hire_requisition_job, $request->all());
        alert()->success('Applicants Shortlisted Successfully');
        return redirect()->back();
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
