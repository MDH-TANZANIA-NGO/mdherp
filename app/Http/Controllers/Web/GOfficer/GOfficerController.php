<?php

namespace App\Http\Controllers\Web\GOfficer;

use App\Exports\ExcelExportDuplicateGOfficerImportedData;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\GOfficer\Datatables\GOfficerDatatables;
use App\Imports\GOfficerImportedTemporaryData;
use App\Imports\GOfficersImport;
use App\Models\Facility\Facility;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GofficerImportedData;
use App\Repositories\Facilities\FacilitiesRepository;
use App\Repositories\GOfficer\GOfficerImportedDataRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GScaleRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use App\Services\Generator\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Symfony\Component\Console\Input\Input;

class GOfficerController extends Controller
{
    use GOfficerDatatables, Number;

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
            ->with('districts', $this->districts->getQuery()->pluck('name','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $duplicate_entries=  GofficerImportedData::query()
                                ->whereHas('gOfficer')
                                ->where('uploaded', false)
                                ->where('user_id', access()->user()->id)
                                ->get();
        $uploaded_successfully=  GofficerImportedData::query()
            ->whereHas('gOfficer')
            ->where('uploaded', true)
            ->where('user_id', access()->user()->id)
            ->get();
        $un_imported_g_officers = GofficerImportedData::query()
            ->where('uploaded', false)
            ->where('user_id', access()->user()->id)
            ->get();




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
            ->with('facilities', Facility::all()->take(10)->pluck('name', 'id'));
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
       /* \Maatwebsite\Excel\Facades\Excel::import(new GOfficersImport, \request()->file('file'));
        alert()->success('Uploaded Successfully', 'Success');
        return redirect()->back();*/

//        dd(Request::all());
        if ($request->hasFile('file')){


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

    public function confirmAndUpload()
    {

        try {
            $upload = GofficerImportedData::query()
                ->where('user_id','=', access()->user()->id)
                ->where('uploaded', false)
                ->each(function ($oldPost) {
                    $newPost = $oldPost->replicate(['user_id','duplicated','uploaded','file_name']);
                    $newPost->setTable('g_officers');
                    $newPost->save();

                });

            if ($upload){
                DB::update('update gofficer_imported_data set uploaded = ? where user_id = ?', [true, access()->user()->id]);
            }
            alert()->success('Uploaded and confirmed successfully', 'Success');

            return redirect()->back();
        }catch (\Exception $exception){

            $exception->getMessage();
            alert()->error('You can not confirm duplicate entries','Not allowed');
            return redirect()->back();
        }



    }

    public function clearImportHistory()
    {


        $delete_imported_data =  GofficerImportedData::query()->where('user_id', access()->user()->id)->forceDelete();

        alert()->success('Import history cleared successfully', 'Success');
        return redirect()->back();

    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportDuplicateImportedData()
    {

     return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportDuplicateGOfficerImportedData(), 'Duplicate Imported Entries.xlsx');


    }

}
