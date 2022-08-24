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
use App\Services\Generator\DefaultFingerprints;

class GOfficerController extends BaseController
{

    use DefaultFingerprints;

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
        if ($request['check_no'] == null)
        {
            $check_no = '0'.$request['region_id'].'-'.sprintf('%02d', now()->month).'-'.substr(sprintf('%02d', now()->year), -2).'-'.rand(1, 200000);

        }
        else{
            $check_no = $request['check_no'];
        }

        $g_officer = GOfficer::create([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => '255'.substr($request['phone'], -9),
            'phone2' => '255'.substr($request['phone2'], -9),
            'g_scale_id' => $request['g_scale_id'],
            'region_id' => $request['region_id'],
            'district_id' => $request['district_id'],
            'gender_cv_id'=>$request['gender_cv_id'],
            'country_organisation_id' => $request['country_organisation_id'],
            'fingerprint_data' => $this->getDefaultFingerprints(),
            'fingerprint_length' => $this->getFingerprintLength(),
            'password' => bcrypt(strtolower($request['last_name'])),
            'isactive' => 1,
            'check_no'=> $request['check_no'],
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
            ->join('facility_g_officer', 'facility_g_officer.g_officer_id', '=','g_officers.id')
            ->join('facilities', 'facilities.id', '=', 'facility_g_officer.facility_id')
            ->join('facility_types', 'facility_types.id', '=', 'facilities.facility_type_id')
            ->join('facility_categories', 'facility_categories.id', '=', 'facility_types.facility_category_id')
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
        $g_officer = GOfficer::find($id);

        $g_officer->fingerprint_data = $request['fingerprint_data'];
        $g_officer->fingerprint_length = $request['fingerprint_length'];

        $g_officer->save();

        $success['g_officer'] = $g_officer;

        return $this->sendResponse($success, "Government Officer updated successfully");
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
