<?php

namespace App\Http\Controllers\Web\HumanResource\StaffHiring;

use App\Http\Controllers\Controller;
use App\Repositories\HumanResource\StaffHiring\StaffHiringRepository;
use Illuminate\Http\Request;

class RefferenceController extends Controller
{
    /**
     * @var StaffHiringRepository
     */
    protected $refereeform;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function __construct()
    {
        $this->refereeform = (new StaffHiringRepository());
    }

    public function index()
    {
        return view('humanResource.StaffHiring.refferenceform');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->refereeform->store($request->all());
        alert()->success('Refference form Submitted Successfully','Success');
        return redirect()->route('refferenceform.end');
    }

    public function end()
    {
        return view('humanResource.StaffHiring.refferenceend');
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
