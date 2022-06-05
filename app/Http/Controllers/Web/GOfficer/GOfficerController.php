<?php

namespace App\Http\Controllers\Web\GOfficer;

use App\Exports\BeneficiaryFilteredExport;
use App\Exports\ExcelExportBeneficiaries;
use App\Exports\ExcelExportDuplicateGOfficerImportedData;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\GOfficer\Datatables\GOfficerDatatables;
use App\Http\Controllers\Web\GOfficer\Datatables\GOfficerImportedDatatables;
use App\Http\Controllers\Web\GOfficer\Datatables\TemporaryImportedBeneficiaryDatatable;
use App\Imports\BulkUpdateBeneficiariesImport;
use App\Imports\GOfficerImportedTemporaryData;
use App\Imports\GOfficersImport;
use App\Models\Facility\Facility;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GofficerImportedData;
use App\Models\System\District;
use App\Repositories\Facilities\FacilitiesRepository;
use App\Repositories\GOfficer\GOfficerImportedDataRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use App\Services\Generator\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isEmpty;

class GOfficerController extends Controller
{
    use GOfficerDatatables, Number, TemporaryImportedBeneficiaryDatatable;



    protected $g_officers;
    protected $g_scales;
    protected $regions;
    protected $districts;
    protected $facilities;
    protected $g_officer_imported_data_repo;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
        $this->g_scales = (new GScaleRepository());
        $this->regions = (new RegionRepository());
        $this->districts =  (new DistrictRepository());
        $this->facilities = (new FacilitiesRepository());
        $this->g_officer_imported_data_repo =  (new  GOfficerImportedDataRepository());

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
            ->with('districts', $this->districts->getQuery()->pluck('name','id'))
            ->with('facilities', $this->facilities->getForPLuck());
    }

    public function bulkUpdate()
    {
        return view('gofficer.gofficer.form.bulkupdate')
            ->with('my_import', $this->g_officer_imported_data_repo->getAccessImportedData()->get())
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('districts', $this->districts->getQuery()->pluck('name','id'))
            ->with('facilities', $this->facilities->getForPLuck());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $duplicate_entries=  $this->g_officer_imported_data_repo->getAccessDuplicate()->get();
        $uploaded_successfully=  $this->g_officer_imported_data_repo->getAccessUploadedSuccessfully()->get();
        $un_imported_g_officers = $this->g_officer_imported_data_repo->getAccessImportedData()->get();



//dd($un_imported_g_officers);
                    //
        return view('gofficer.gofficer.form.create')
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('un_sync_g_officers', $un_imported_g_officers)
            ->with('duplicate_entries', $duplicate_entries)
            ->with('uploaded_and_confirmed', $uploaded_successfully)
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('regions', $this->regions->getQuery()->pluck('name','id'))
            ->with('facilities', Facility::all()->pluck('name', 'id'))
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
        $g_officer = $this->g_officers->findByUuid($uuid);

        return view('gofficer.gofficer.form.edit')
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('g_officer',$this->g_officers->findByUuid($uuid))
            ->with('g_scales', $this->g_scales->getActiveForPluck())
            ->with('g_officer_facility', $this->facilities->getGofficerFacility($g_officer->id))
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

    public function import(Request $request)
    {

        if ($request->hasFile('file')){

//            $file_name = $request->file('file')->getClientOriginalName();
//            $temporary_store = new GOfficerImportedTemporaryData($file_name);
//            $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
//            alert()->warning('Please confirm imported data', 'Confirm');
//            return redirect()->back();
            try {
                $file_name = $request->file('file')->getClientOriginalName();
                $temporary_store = new GOfficerImportedTemporaryData($file_name);
                $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
                alert()->warning('Please confirm imported data', 'Confirm');
                 return redirect()->back();
             }catch (\Exception $exception){
                 alert()->error('Something is wrong with your file. Please review and try again','Oohps');
                 $exception->getMessage();
                 return redirect()->back();
             }
        }
        else{

            alert()->error('You have not attach any file', 'Failed');

            return redirect()->back();
        }


    }

    public function bulkUpdateImport(Request $request)
    {

        if ($request->hasFile('file')){

            $file_name = $request->file('file')->getClientOriginalName();
            $temporary_store = new BulkUpdateBeneficiariesImport($file_name);
            $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
            alert()->warning('Please confirm imported data', 'Confirm');
            return redirect()->back();
//            try {
//                $file_name = $request->file('file')->getClientOriginalName();
//                $temporary_store = new BulkUpdateBeneficiariesImport($file_name);
//                $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
//                alert()->warning('Please confirm imported data', 'Confirm');
//                return redirect()->back();
//            }catch (\Exception $exception){
//                alert()->error('Something is wrong with your file. Please review and try again','Oohps');
//                $exception->getMessage();
//                return redirect()->back();
//            }
        }
        else{

            alert()->error('You have not attach any file', 'Failed');

            return redirect()->back();
        }


    }

    public function confirmAndUpload()
    {
//        try {
            $upload = $this->g_officer_imported_data_repo->getAccessImportedData()->get();
            $duplicates = [];
            foreach ($upload as $data)
            {
                $check_duplicate = $this->g_officers->getQuery()->where('phone', $data->phone);

                if ($check_duplicate->count())
                {
                    array_push($duplicates,$data->phone);

                }

            }
            if (empty($duplicates)){
                foreach ($upload as $data)
                {
                    $this->g_officers->query()->create([
                        'first_name'=>$data->first_name,
                        'middle_name'=>$data->middle_name,
                        'last_name'=>$data->last_name,
                        'phone'=>$data->phone,
                        'region_id'=>$data->region_id,
                        'password'=>$data->password,
                        'fingerprint_data'=>$data->fingerprint_data,
                        'fingerprint_length'=>$data->fingerprint_length,
                        'check_no'=>$data->check_no,
                    ]);

                }
                $this->g_officer_imported_data_repo->getAccessImportedData()->forceDelete();
                alert()->success('Beneficiaries have been registered successfully','Success');

                return  redirect()->back();
            }
            if (!empty($duplicates)){
                alert()->error('Your file has duplicate beneficiaries entries.','Failed');
                return redirect()->back();
            }
    }

    public function pushBulkUpdate()
    {
        $upload = $this->g_officer_imported_data_repo->getAccessImportedData()->get();
        $tobe_updated = [];
        foreach ($upload as $data) {
            $check_data = $this->g_officers->getQuery()->where('g_officers.uuid', $data->referenced_uuid);


            if ($check_data->count() > 0)
            {
                $check_data->update([
                    'first_name'=>$data->first_name,
                    'middle_name'=>$data->middle_name,
                    'last_name'=>$data->last_name,
                    'phone'=>$data->phone,
                    'phone2'=>$data->phone2,
                    'region_id'=>$data->region_id,
                    'password'=>$data->password,
                    'fingerprint_data'=>$data->fingerprint_data,
                    'fingerprint_length'=>$data->fingerprint_length,
                    'check_no'=>$data->check_no,
                    'district_id'=>$data->district_id,
                    'gender_cv_id'=> $data->gender_cv_id == null ? 6: $data->gender_cv_id,
                    'g_scale_id'=>$data->g_scale_id,
                    'government_scale_id'=>$data->government_scale_id,
                ]);
            }
        }
        $this->g_officer_imported_data_repo->getAccessImportedData()->forceDelete();

        alert()->success('You have updated bulk beneficiaries successfully','Success');
        return redirect()->back();
    }

    public function clearImportHistory()
    {

         $this->g_officer_imported_data_repo->getAccessDuplicate()->forceDelete();

        alert()->success('Duplicate entries have been removed successfully', 'Success');
        return redirect()->back();

    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportDuplicateImportedData()
    {
        $get_duplicate_entries_count = $this->g_officer_imported_data_repo->getAccessDuplicate()->get()->count();

        if ($get_duplicate_entries_count > 0 )
        {
            return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportDuplicateGOfficerImportedData(), 'Duplicate Imported Entries.xlsx');

        }
        if ($get_duplicate_entries_count <= 0)
        {
            alert()->error('You do not have duplicate entries to export');
            return  redirect()->back();
        }



    }

    public function getDistricts($id)
    {
        return response()->json($this->districts->query()->where('region_id', $id)->get());
    }
    public function getFacilities($id)
    {
        return response()->json($this->districts->getFacilitiesByDistrict($id)->get());
    }
    public function filterGofficer(Request $request)
    {

        if (isset($request['region']) and $request['districts']== null)
        {
            $get_filtered_g_officers_by_region = $this->g_officers->getFilteredGofficerByRegion($request['region'])->get();
            return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportBeneficiaries($get_filtered_g_officers_by_region), 'Beneficiaries List.xlsx');


        }
        if (isset($request['districts']))
        {
            $get_filtered_g_officers_by_district =  $this->g_officers->getFilterGOfficerByDistrict($request['districts'])->get();
            return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportBeneficiaries($get_filtered_g_officers_by_district), 'Beneficiaries List.xlsx');


        }



        return  redirect()->back();

    }
    public function filterBulkGOfficer(Request $request)
    {

        if (isset($request['region']) and $request['districts']== null)
        {
            $get_filtered_g_officers_by_region = $this->g_officers->getFilteredGofficerByRegion($request['region'])->get();
            return \Maatwebsite\Excel\Facades\Excel::download(new BeneficiaryFilteredExport($get_filtered_g_officers_by_region), 'Beneficiaries List.xlsx');


        }
        if (isset($request['districts']))
        {
            $get_filtered_g_officers_by_district =  $this->g_officers->getFilterGOfficerByDistrict($request['districts'])->get();
            return \Maatwebsite\Excel\Facades\Excel::download(new BeneficiaryFilteredExport($get_filtered_g_officers_by_district), 'Beneficiaries List.xlsx');


        }



        return  redirect()->back();

    }

}
