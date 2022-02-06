<?php

namespace App\Http\Controllers\Api\MDHData;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\RegionRepository;

class GOfficerController extends BaseController
{

    protected $g_officers;
    protected $g_scales;
    protected $regions;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
        $this->g_scales = (new GScaleRepository());
        $this->regions = (new RegionRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginated_g_officers = $this->g_officers->getQuery()->paginate(20);
        $success['paginated_g_officers'] = $paginated_g_officers;
        return $this->sendResponse($success, 'All GOfficers');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
