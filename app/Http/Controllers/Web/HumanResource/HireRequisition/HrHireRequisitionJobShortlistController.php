<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobShortlistRepository;
use Illuminate\Http\Request;

class HrHireRequisitionJobShortlistController extends Controller
{
    protected $hr_hire_requisition_job_shortlists;

    public function __construct()
    {
        $this->hr_hire_requisition_job_shortlists = (new HrHireRequisitionJobShortlistRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortlist(HireRequisitionJob $hire_requisition_job, $input)
    {
        $this->hr_hire_requisition_job_shortlists->shortlist($hire_requisition_job, $input);
        alert()->success('Shortlist Has been done Successfully');
        return view('HumanResource.HireRequisition.shortlist.show');
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
    public function store(Request $request)
    {
        //
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
