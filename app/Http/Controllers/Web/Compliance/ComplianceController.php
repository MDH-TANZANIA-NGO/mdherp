<?php

namespace App\Http\Controllers\Web\Compliance;

use App\Exports\ExcelExportBeneficiaries;
use App\Exports\ExcelExportDuplicateGOfficerImportedData;
use App\Http\Controllers\Controller;
use App\Models\Facility\Facility;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    //

    protected $g_officers;
    protected $g_scales;
    protected $regions;
    protected $districts;


    public function __construct()
    {
        $this->g_scales = (new GScaleRepository());
        $this->g_officers = (new GOfficerRepository());
        $this->regions =  (new RegionRepository());
        $this->districts = (new DistrictRepository());


    }
    public function index()
    {

    }
    public function beneficiaries()
    {
        return view('compliance.index')
            ->with('g_officers', $this->g_officers->getActive())
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('districts', $this->districts->getQuery()->pluck('name','id'))
            ->with('facilities', Facility::all()->pluck('name', 'id')->take(10));
    }
    public function exportallBeneficiaries()
    {

        return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportBeneficiaries(), 'Beneficiaries List.xlsx');


    }
}
