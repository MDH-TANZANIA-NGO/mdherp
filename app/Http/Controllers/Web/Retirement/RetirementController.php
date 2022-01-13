<?php

namespace App\Http\Controllers\Web\Retirement;

use App\Http\Controllers\Controller;
use App\Models\Retirement\Retirement;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use Illuminate\Http\Request;

class RetirementController extends Controller
{
    protected $retirements;
    protected $safari_advances;

    public function __construct()
    {
        $this->retirements = (new RetirementRepository());
        $this->safari_advances = (new SafariAdvanceRepository());
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
        return view('retirement.forms.create')
            ->with('retirement', $retirement);
    }

    public function store(Request $request)
    {
        $retirement = $this->retirements->store($request->all());
        return redirect()->route('retirement.create', $retirement);
    }

}
