<?php

namespace App\Http\Controllers\Web\HumanResource\StaffHiring;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InterviewConfirmController extends Controller
{
    public function index(){
        return view('HumanResource.StaffHiring.interviewconfirm');
        }
}
