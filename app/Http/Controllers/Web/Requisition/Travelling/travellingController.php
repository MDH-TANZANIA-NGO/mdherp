<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class travellingController extends Controller
{
    protected $travelling_costs;

    public function __construct()
    {

    }

    public function index()
    {

        return view('requisition.travelling.index');

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

}
