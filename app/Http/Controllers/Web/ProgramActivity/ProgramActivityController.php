<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Http\Controllers\Controller;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;

class ProgramActivityController extends Controller
{
    protected $trainings;

    public function __construct()
    {
        $this->trainings = (new RequisitionTrainingRepository());
    }

    public function index()
    {
        return view('programactivity.index');
    }
    public  function  initiate()
    {

        return view('programactivity.forms.initiate')
            ->with('trainings', $this->trainings->getPluckRequisitionNo());
    }
    public function store()
    {

    }
}
