<?php

namespace App\Http\Controllers\Web\Retirement;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Models\Retirement\Retirement;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\System\DistrictRepository;
use App\Services\Generator\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetirementController extends Controller
{
    use Number;
    protected $retirements;
    protected $safari_advances;
    protected $safari_advance_details;
    protected $district;
    //protected $retiresafari;

    public function __construct()
    {
        $this->retirements = (new RetirementRepository());
        $this->safari_advances = (new SafariAdvanceRepository());
        $this->district=(new DistrictRepository());
    }

    public function index()
    {
        return view('retirement.index');
    }

    public  function  initiate(SafariAdvanceRepository $safariAdvanceRepository)
    {
//        dd($safariAdvanceRepository->getCompletedWithoutRetirement()->get());
//        dd($safariAdvanceRepository->getCompletedWithoutRetirement());
        return view('retirement.forms.initiate')
            ->with('safaries', $safariAdvanceRepository->getCompletedWithoutRetirement()->get()
                ->pluck('number','id'));
    }

//    public  function  create(Retirement $retirement)
//    {
//
////        dd($this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
//        return view('retirement.forms.create')
//            ->with('retirement', $retirement)
//            ->with('district', $this->district->getForPluck())
//            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
//    }

    public  function  create(Retirement $retirement)
    {

        return view('retirement.forms.create')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safaris', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
    }

    public function store(Request $request)
    {
        $retirement = $this->retirements->store($request->all());
        return redirect()->route('retirement.create', $retirement);
    }

    public function update(Request $request, $uuid)
    {
        //ddd($request->all());
        $this->retirements->update($request->all(),$uuid);
//        $retire = $this->retiresafari->findByUuid($uuid);
        $retirement = $this->retirements->findByUuid($uuid);
        $wf_module_group_id = 4;
        $next_user = $retirement->user->assignedSupervisor()->supervisor_id;
        dd($next_user);
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $retirement->id,'region_id' => $retirement->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

        return redirect()->route('retirement.index',$uuid);
    }

    /*public function update(Request $request, $uuid)
    {
        $retire = $this->retirements->findByUuid($uuid);
       $number = $this->generateNumber($retire);
       var_dump($number);

        DB::table('retirements_details')->insert(
            [
                'safari_advance_id'=>$request['safari_advance_id'],
                'number' => $number,
                'from'=>$request['from'],
                'to'=>$request['to'],
                'uuid' => $uuid,
                'district_id'=>$request['district_id'],
                'amount_requested'=>$request['amount_requested'],
                'amount_paid'=>$request['amount_paid'],
                'amount_received'=>$request['amount_received'],
                'activity_report'=>$request['activity_report']
            ]
        );


        return redirect()->route('retirement.index',$uuid);
    }*/


}
