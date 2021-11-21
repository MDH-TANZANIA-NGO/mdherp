<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class trainingController extends Controller
{
    protected $training_costs;

    public function __construct()
    {

    }

    public function index()
    {

        return view('requisition.training.index');

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
