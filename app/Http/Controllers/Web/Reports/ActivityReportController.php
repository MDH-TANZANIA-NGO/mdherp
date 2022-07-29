<?php

namespace App\Http\Controllers\Web\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityReportController extends Controller
{
    //
   

    public function __construct()
    {


    }

    public function index()
    {
        return view('Reports.Activity.index');
    }
}
