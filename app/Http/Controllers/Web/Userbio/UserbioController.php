<?php

namespace App\Http\Controllers\Web\Userbio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Userbio\Datatables\UserBioDatatables;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\Auth\User;
use App\Models\Employee\Employee;
use App\Repositories\Access\UserRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Userbio;
use Illuminate\Http\Request;

class UserbioController extends Controller
{

    use UserBioDatatables, UserRelationship;

    private $users;
    private $designations;
    private $regions;
    private $bio;

    public function __construct()
    {
        $this->designations = (new DesignationRepository());
        $this->regions = (new RegionRepository());
        $this->users = (new UserRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('userbio.index')
            ->with('active_user_count', $this->users->getActive()->get()->count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $userbio2= Employee::where('user_id', access()->id())->first();
        $userbio3= access()->user();

        return view('userbio.forms.createbio')
            ->with('bio', $userbio2?? 'Bio goes here')
            ->with('user', $userbio3);
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
     * @param  \App\Userbio  $userbio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($uuid)
    {
        $userbio= $this->users->findByUuid($uuid);
        $userbio2= Employee::where('user_id', access()->id())->first();


        return view('userbio.forms.userbioprofile')
            ->with('userbio', $userbio)
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect())
            ->with('bio', $userbio2?? 'Bio goes here');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Userbio  $userbio
     * @return \Illuminate\Http\Response
     */
    public function edit(Userbio $userbio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userbio  $userbio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userbio $userbio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userbio  $userbio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userbio $userbio)
    {
        //
    }
}
