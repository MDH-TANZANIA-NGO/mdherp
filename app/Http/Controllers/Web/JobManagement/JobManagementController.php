<?php

namespace App\Http\Controllers\Web\JobManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobManagementController extends Controller
{
    //

    public function index()
    {
        return view('humanResource.JobManagement.index');
    }
}
