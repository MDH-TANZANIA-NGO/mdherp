<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->with('requisition', $requisition);
    }
    public  function  initiate()
    {
        return view('safari.forms.create');
    }
}
