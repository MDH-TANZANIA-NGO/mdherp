<?php

namespace App\Http\Controllers\Web\Person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Person\Traits\FamilyDatatable;
use App\Models\Employee\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    use FamilyDatatable;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('person.family.create')
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('relations', code_value()->query()->where('code_id',12)->pluck('name','id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        Family::create([
            'user_id' => access()->id(),
            'name' => $request['name'],
            'gender_cv_id' => $request['gender_cv_id'],
            'relationship_cv_id' => $request['relationship_cv_id'],
            'phone' => $request['phone'],
            'dob' => $request['dob'],
            'is_next_of_kin' => $request['is_next_of_kin'],
            'is_emergency' => $request['is_emergency']
        ]);

        return redirect()->route('person.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $boolean = [0,1];
        return view('person.family.show')
            ->with('family', $family)
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('relations', code_value()->query()->where('code_id',7)->pluck('name','id'))
            ->with('boolean', $boolean);
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
    public function update(Request $request, $id)
    {
        dd($request->all());
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
