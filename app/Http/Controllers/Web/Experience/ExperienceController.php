<?php

namespace App\Http\Controllers\Web\Experience;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Education\Traits\EducationDatatable;
use App\Http\Controllers\Web\Experience\Traits\ExperienceDatatable;
use App\Models\Experience\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    use ExperienceDatatable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('experience.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Experience::create([
            'user_id' => access()->id(),
            'organisation_name' => $request->get('organisation_name'),
            'position' => $request->get('position'),
            'summary' => $request->get('summary'),
            'supervisor' => $request->get('supervisor'),
            'start_year' => $request->get('start_year'),
            'end_year' => $request->get('end_year')
        ]);

        alert()->success('Academic Details Added Successfully','success');
        return redirect()->route('experience.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        return view('experience.show')
            ->with('experience', $experience);
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
    public function update(Request $request, Experience $experience)
    {
        $experience->update($request->only([
            'organisation_name',
            'position',
            'summary',
            'supervisor',
            'start_year',
            'end_year'
        ]));

        return redirect()->route('experience.index');
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
