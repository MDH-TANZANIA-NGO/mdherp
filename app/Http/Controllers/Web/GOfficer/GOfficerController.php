<?php

namespace App\Http\Controllers\Web\GOfficer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\GOfficer\Datatables\GOfficerDatatables;
use App\Imports\GOfficersImport;
use App\Models\Facility\Facility;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class GOfficerController extends Controller
{
    use GOfficerDatatables;

    protected $g_officers;
    protected $g_scales;
    protected $regions;
    protected $districts;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
        $this->g_scales = (new GScaleRepository());
        $this->regions = (new RegionRepository());
        $this->districts =  (new DistrictRepository());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('gofficer.gofficer.index')
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('districts', $this->districts->getQuery()->pluck('name','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('gofficer.gofficer.form.create')
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('districts', $this->districts->getQuery()->pluck('name','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->g_officers->store($request->all());
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

        return view('gofficer.gofficer.form.edit')
            ->with('g_officer',$this->g_officers->findByUuid($uuid))
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('districts', $this->districts->getQuery()->pluck('name','id'))
            ->with('facilities', Facility::all()->pluck('name', 'id'));
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
        $this->g_officers->update($uuid, $request->all());
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

    public function import()
    {
       /* \Maatwebsite\Excel\Facades\Excel::import(new GOfficersImport, \request()->file('file'));
        alert()->success('Uploaded Successfully', 'Success');
        return redirect()->back();*/

//        dd(Request::all());
        try {
            \Maatwebsite\Excel\Facades\Excel::import(new GOfficersImport, \request()->file('file'));
            alert()->success('Uploaded Successfully', 'Success');
            return redirect()->back();
        }catch (\Exception $exception){
            alert()->error('You have Duplicate Entry','Failed');
            $exception->getMessage();
            return redirect()->back();
        }

    }
}
