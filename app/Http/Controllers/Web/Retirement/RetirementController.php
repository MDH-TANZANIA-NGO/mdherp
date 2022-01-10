<?php

namespace App\Http\Controllers\Web\Retirement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RetirementController extends Controller
{
    public function index()
    {
        return view('retirement.index');
    }

    public  function  initiate()
    {
        return view('retirement.forms.initiate');
    }

    public  function  create()
    {
        return view('retirement.forms.create');
    }

}
