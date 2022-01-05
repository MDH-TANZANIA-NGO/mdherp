<?php

namespace App\Http\Controllers\Web\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceActivityController extends Controller
{
    public function index()
    {
        return view('finance.index');
    }
}
