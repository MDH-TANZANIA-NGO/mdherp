<?php

namespace App\Http\Controllers\Web\GOfficer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\GOfficer\Datatables\GRateDatatables;
use App\Repositories\GOfficer\GRateRepository;
use Illuminate\Http\Request;

class GRateController extends Controller
{
    use GRateDatatables;

    protected $g_rates;

    public function __construct()
    {
        $this->g_rates = (new GRateRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->g_rates->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($uuid)
    {
        return view('gofficer.grate.form.edit')
            ->with('g_rate', $this->g_rates->findByUuid($uuid));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $this->g_rates->update($uuid, $request->all());
        return redirect()->back();
    }

    public function assignRate(Request $request)
    {
        $this->g_rates->assignRate($request->all());
        return redirect()->back();
    }
}
