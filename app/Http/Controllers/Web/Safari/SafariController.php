<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    protected $requisition;

    public function __construct()
    {
        $this->requisition = (new RequisitionRepository());
    }

    public function index()
    {
        return view('safari.index')
           ;
    }
    public  function  create(Requisition $requisition)
    {
        return view('safari.forms.initiate')
            ->with('requisition', $this->requisition->getQuery());
    }
    public  function  initiate()
    {
        return view('safari.forms.create');
    }
}
