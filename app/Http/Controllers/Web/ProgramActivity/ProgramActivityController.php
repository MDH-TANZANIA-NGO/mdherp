<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramActivityController extends Controller
{
    public function index()
    {
        return view('programactivity.index');
    }
}
