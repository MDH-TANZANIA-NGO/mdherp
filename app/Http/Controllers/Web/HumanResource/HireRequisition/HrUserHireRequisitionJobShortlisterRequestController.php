<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobRequest;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequestRepository;

class HrUserHireRequisitionJobShortlisterRequestController extends Controller
{
    protected $job_shortlister_requests;
    protected $users;

    public function __construct()
    {
        $this->job_shortlister_requests = (new HrUserHireRequisitionJobShortlisterRequestRepository());
        $this->users = (new UserRepository());
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
    public function initiate($uuid)
    {
        $job_shortlister_request = $this->job_shortlister_requests->findByUuid($uuid);
        return view('HumanResource.HireRequisition.shortlister.initiate')
        ->with('job_shortlister_request',$job_shortlister_request)
        ->with('jobs',$job_shortlister_request->jobs)
        ->with('users',$this->users->pluckWithDesignation());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job_shortlister_request =$this->job_shortlister_requests->store($request->all());
        alert()->success('Shortlister Added Successfully');
        return redirect()->route('job_shortlister.initiate',$job_shortlister_request);
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
