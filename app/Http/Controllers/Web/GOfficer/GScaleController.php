<?php

namespace App\Http\Controllers\Web\GOfficer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\GOfficer\Datatables\GScaleDatatables;
use App\Http\Requests\GOfficer\GScaleRequest;
use App\Repositories\GOfficer\GScaleRepository;
use Illuminate\Http\Request;

class GScaleController extends Controller
{
    use GScaleDatatables;

    protected $g_scales;

    public function __construct()
    {
        $this->g_scales = (new GScaleRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('gofficer.gscale.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GScaleRequest $request)
    {
        $this->g_scales->store($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('gofficer.gscale.form.edit')
            ->with('g_scale', $this->g_scales->findByUuid($uuid));
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->g_scales->update($uuid, $request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
