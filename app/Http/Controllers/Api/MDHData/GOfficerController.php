<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Resources\DistrictResource as DistrictResource;
use App\Http\Resources\RegionResource as RegionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UnitResource as UnitResource;
use App\Models\System\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\System\DistrictRepository;
use App\Models\GOfficer\GOfficer;
use Illuminate\Support\Facades\DB;

class GOfficerController extends BaseController
{

    protected $g_officers;
    protected $g_scales;
    protected $regions;
    protected $districts;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
        $this->g_scales = (new GScaleRepository());
        $this->regions = (new RegionRepository());
        $this->districts = (new DistrictRepository());
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
        $districts = District::all();

        $countries_organisations = DB::table("country_organisation")
            ->selectRaw('country_organisation.id as id, countries.name as country, organisations.name as organisation')
            ->leftJoin('organisations', 'organisations.id', '=', 'organisation_id')
            ->leftJoin('countries', 'countries.id', '=', 'country_id')
            ->get();

        $success['countries_organisations'] = $countries_organisations;
        $success['regions'] = $this->regions->getQuery()->get();
        $success['districts'] = DistrictResource::collection($districts);
        $success['g_scales'] = $this->g_scales->getQuery()->get();

        return $this->sendResponse($success, "Collections");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $g_officer = GOfficer::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'g_scale_id' => $request['g_scale'],
            'region_id' => $request['region_id'],
            'district_id' => $request['district_id'],
            'country_organisation_id' => $request['country_organisation_id'],
            'fingerprint_data' => $request['fingerprint_data'],
            'fingerprint_length' => $request['fingerprint_length'],
        ]);
        $success['g_officer'] = $g_officer;

        return $this->sendResponse($success, "Government Officers successfully registered");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $g_officer_facilities = DB::table('g_officers')
            ->selectRaw('facilities.id as facility_id')
            ->selectRaw('facilities.name as facility_name')
            ->selectRaw('facilities.number as facility_number')
            ->selectRaw('facility_types.name as facility_type')
            ->leftJoin('facility_g_officer', 'facility_g_officer.g_officer_id', '=','g_officers.id')
            ->leftJoin('facilities', 'facilities.id', '=', 'facility_g_officer.facility_id')
            ->leftJoin('facility_types', 'facility_types.id', '=', 'facilities.facility_type_id')
            ->leftJoin('facility_categories', 'facility_categories.id', '=', 'facility_types.facility_category_id')
            ->where('g_officers.id', $id)
            ->get();

        $success['facilities'] = $g_officer_facilities;

        return $this->sendResponse($success, "Government Officer Facilities");
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
