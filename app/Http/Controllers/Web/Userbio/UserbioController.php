<?php

namespace App\Http\Controllers\Web\Userbio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Userbio\Datatables\UserBioDatatables;
use App\Model\Userbio\Userbio;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\Auth\User;
use App\Models\Employee\Employee;
use App\Repositories\Access\UserRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        return view('userbio.index')
            ->with('active_user_count', $this->users->getActive()->get()->count());
    }


    public function create()
    {
        $userbio = Userbio::where('user_id', access()->id())->pluck('bio')->first();
        return view('userbio.forms.createbio')
            ->with('userbio', $userbio?? null);
    }

    public function store(Request $request)
    {
        $userbio = Userbio::where('user_id', access()->id())->first();
        if ($userbio == null){
            Userbio::create([
                'user_id'=> access()->user()->id,
                'bio' => $request['bio']
            ]);
            alert()->success('Biography created successfully','Great!');
            return redirect()->back();
        }
        $userbio->update([
            'bio' => $request['bio']
        ]);
        alert()->success('Biography Updated Succesfully','Great!');
        return redirect()->back();
    }


    public function show($uuid)
    {
        $user= $this->users->findByUuid($uuid);
        $userbio= Userbio::where('user_id', $user->id)->first();

        if($userbio== null)
        {
            $userbio = null;
        }

        return view('userbio.forms.userbioprofile')
            ->with('user', $user)
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect())
            ->with('bio', $userbio);
    }


    public function edit(Userbio $userbio)
    {
        //
    }


    public function update(Request $request, Userbio $userbio)
    {
        //
    }


    public function destroy(Userbio $userbio)
    {
        //
    }
}
