<?php

namespace App\Http\Controllers\Web\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\RateRequest;
use App\Repositories\Rate\RateRepository;
use App\Http\Controllers\Web\Rate\Datatables\RateDatatables;

class RateController extends Controller
{
    use RateDatatables;

    protected $rates;
    protected $wf_tracks;

    public function __construct()
    {
        $this->rates = (new RateRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rate.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request)
    {
        $this->rates->store($request->all());
        alert()->success(__('Stored Successfully'), __('Rate'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        return view('rate.display.show')
            ->with('rate', $rate);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param RateRequest $request
     * @param Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function update(RateRequest $request, Rate $rate)
    {
        $this->rates->update($rate, $request->all());
        alert()->success(__('Updated Successfully'), __('Rate'));
        return redirect()->back();
    }

}
