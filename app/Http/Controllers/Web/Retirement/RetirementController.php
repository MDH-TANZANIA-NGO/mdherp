<?php

namespace App\Http\Controllers\Web\Retirement;

use App\Http\Controllers\Controller;
use App\Models\Retirement\Retirement;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;

class RetirementController extends Controller
{
    protected $retirements;
    protected $safari_advances;
    protected $safari_advance_details;
    protected $district;

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

    public  function  create(Retirement $retirement)
    {

//        dd($this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
        return view('retirement.forms.create')
            ->with('retirement', $retirement)
            ->with('district', $this->district->getForPluck())
            ->with('retire_safari', $this->safari_advances->getSafariDetails()->get()->where('safari_id', $retirement->safari_advance_id));
    }

    public function store(Request $request)
    {
        $retirement = $this->retirements->store($request->all());
        return redirect()->route('retirement.create', $retirement);
    }

}
