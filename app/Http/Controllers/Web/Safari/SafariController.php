<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    public function index()
    {
        return view('safari.index');
    }
    public  function  create()
    {
        return view('safari.forms.initiate');
    }
    public  function  initiate()
    {
        return view('safari.forms.create');
    }
}
