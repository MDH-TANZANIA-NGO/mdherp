<?php

namespace App\Http\Controllers\Web\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('events.index');
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        return view('');
    }

    public function edit($id)
    {
        return view('');
    }

    public function update(Request $request, $id)
    {
        return view('');
    }

    public function delete($id)
    {
        return view('');
    }
}
