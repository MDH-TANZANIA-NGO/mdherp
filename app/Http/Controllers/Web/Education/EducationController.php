<?php

namespace App\Http\Controllers\Web\Education;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Education\Traits\EducationDatatable;
use App\Models\Education\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    use EducationDatatable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('education.index')
            ->with('educations', code_value()->query()->where('code_id',10)->get());
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
        Education::create([
            'user_id' => access()->id(),
            'institution_name' => $request->get('institution_name'),
            'award_received' => $request->get('award_received'),
            'certificate' => $request->file('certificate') ? $request->file('certificate')->store('hr/certificates') : null,
            'start_year' => $request->get('start_year'),
            'end_year' => $request->get('end_year'),
            'education_level_cv_id' => $request->get('education_level_cv_id'),
        ]);
        alert()->success('Academic Details Added Successfully','success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Education $education)
    {
        return view('education.show')
            ->with('educations', code_value()->query()->where('code_id',8)->pluck('name','id'))
            ->with('education', $education);
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
    public function update(Request $request, Education $education)
    {
        $request->validate([
            'certificate' => ['nullable', 'file'],
        ]);
        $education->update($request->only([
            'institution_name',
            'award_received',
            'start_year',
            'end_year',
            'education_level_cv_id'
        ]));

        if ($request->file('certificate')){
            $education->update(['certificate' =>  $request->file('certificate')->store('certificates')]);
        }

        return redirect()->route('education.index');
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
