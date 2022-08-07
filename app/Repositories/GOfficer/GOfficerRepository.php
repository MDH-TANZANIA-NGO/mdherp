<?php

namespace App\Repositories\GOfficer;

use App\Exports\ExcelExportBeneficiaries;
use App\Imports\GOfficerImportedTemporaryData;
use App\Models\GOfficer\GOfficer;
use App\Models\Regions\region;
use App\Models\System\District;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Services\Generator\DefaultFingerprints;
use Matrix\Exception;

class GOfficerRepository extends BaseRepository
{
    use DefaultFingerprints;

    const MODEL = GOfficer::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('g_officers.id AS g_officer_id'),
            DB::raw('g_officers.first_name AS first_name'),
            DB::raw('g_officers.middle_name AS middle_name'),
            DB::raw('g_officers.last_name AS last_name'),
            DB::raw('g_officers.email AS email'),
            DB::raw('g_officers.phone AS phone'),
            DB::raw('g_officers.phone2 AS phone2'),
            DB::raw('g_officers.gender_cv_id AS gender'),
            DB::raw("CONCAT_WS(', ',g_officers.last_name, g_officers.first_name) AS names"),
            DB::raw("CONCAT_WS(', ',g_officers.last_name, g_officers.first_name,  g_officers.phone) AS unique"),
            DB::raw('g_officers.uuid AS uuid'),
            DB::raw('g_officers.g_scale_id as g_scale_id'),
            DB::raw('g_scales.title AS g_scale_title'),
            DB::raw('g_rates.amount AS g_rate_amount'),
            DB::raw('g_officers.region_id AS region_id'),
            DB::raw('regions.name AS region_name'),
            DB::raw('g_officers.district_id as district_id'),
            DB::raw('districts.name as district'),
            DB::raw('g_officers.country_organisation_id as country_organisation_id'),
            DB::raw('g_officers.isactive as isactive'),
            DB::raw('g_officers.check_no as check_no'),
            DB::raw('g_officers.fingerprint_data as fingerprint_data'),
            DB::raw('g_officers.fingerprint_length as fingerprint_length'),
            DB::raw('g_officers.isactive as isactive'),
            DB::raw("string_agg(DISTINCT facilities.name, ',') as facilities"),
        ])
            ->leftjoin('g_scales','g_scales.id','g_officers.g_scale_id')
            ->leftjoin('g_rate_scale','g_rate_scale.g_scale_id','g_scales.id')
            ->leftjoin('g_rates','g_rates.id','g_rate_scale.g_rate_id')
            ->leftjoin('regions', 'regions.id', 'g_officers.region_id')
            ->leftjoin('covids', 'covids.data_clerk_id', 'g_officers.id')
            ->leftjoin('facility_g_officer', 'facility_g_officer.g_officer_id', 'g_officers.id')
            ->leftjoin('facilities', 'facilities.id', 'facility_g_officer.facility_id')
            ->leftjoin('districts', 'districts.id', 'g_officers.district_id')
            ->groupby('g_officers.id', 'g_scales.title', 'g_rates.amount', 'regions.name', 'districts.name');
    }
    public function getForPluckUnique()
    {
        return $this->getQuery()
            ->pluck('unique', 'id');
    }


    public function getActive()
    {
        return $this->getQuery();
    }
    public function getNotSelectedInActivity()
    {
        return $this->getQuery()
            ->whereHas('Training');
    }
    public function getDuplicated()
    {
        return $this->query()->select([
            DB::raw('g_officers.id AS id'),
            DB::raw('g_officers.first_name AS first_name'),
            DB::raw('g_officers.last_name AS last_name'),
            DB::raw('g_officers.phone AS phone'),
        ])
            ->leftjoin('g_officers', 'g_officers.phone', 'g_officer_imported_data.phone');
    }
    public function inputProcess($inputs)
    {
        $region_id = region::query()->where('id', District::query()->where('id', $inputs['district_id'])->first()->region_id)->first()->id;

        if ($inputs['check_no'] == null)
        {
            $check_no = '0'.$region_id.'-'.sprintf('%02d', now()->month).'-'.substr(sprintf('%02d', now()->year), -2).'-'.rand(1, 200000);

        }
        else{
            $check_no = $inputs['check_no'];
        }


        return [
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'middle_name' => $inputs['middle_name'],
            'phone' => '255'.substr($inputs['phone'], -9),
            'g_scale_id' => $inputs['g_scale'],
            'region_id' => $region_id,
            'gender_cv_id'=>$inputs['gender'],
            'district_id' => $inputs['district_id'],
            'country_organisation_id' => 1,
            'isactive' => 1,
            'fingerprint_data' => $this->getDefaultFingerprints(),
            'fingerprint_length' => $this->getFingerprintLength(),
            'password' => bcrypt(strtolower($inputs['last_name'])),
            'check_no'=> $check_no
        ];
    }

    public function store($inputs)
    {

        try {
            return DB::transaction(function () use ($inputs){
                $id = $this->query()->create($this->inputProcess($inputs))->id;
                $g_officer =  $this->find($id);
                if (isset($inputs['facilities']))
                    $g_officer->facilities()->sync($inputs['facilities']);

                alert()->success('External user registered successfully', 'Success');
                return redirect()->back();
            });
        }catch (\Exception $exception){
            alert()->error('User with this phone number Exists', 'Failed');

            return redirect()->back();
        }
    }

    public function update($uuid, $inputs)
    {
        $g_officer = $this->findByUuid($uuid);

        return DB::transaction(function () use ($g_officer, $inputs){
          if (isset($inputs['facilities']))
              $g_officer->facilities()->sync($inputs['facilities']);
              return $g_officer->update($this->inputProcess($inputs));



        });
    }

    public function import($inputs,$file_name )
    {
        $temporary_store = new GOfficerImportedTemporaryData($file_name);
        $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
        alert()->warning('Please confirm imported data', 'Confirm');
        return redirect()->back();
//        try {
//            $temporary_store = new GOfficerImportedTemporaryData($file_name);
//            $import_to_temporary_store = \Maatwebsite\Excel\Facades\Excel::import($temporary_store, \request()->file('file'));
//            alert()->warning('Please confirm imported data', 'Confirm');
//            return redirect()->back();
//        }catch (\Exception $exception){
//            alert()->error('Something is wrong with your file. Please review and try again','Oohps');
//            $exception->getMessage();
//            return redirect()->back();
//        }
    }

    public function getGOfficerAuth($id)
    {
        return $this->getQuery()->where('g_officers.id',$id)->first();
    }
public function getFilteredGofficerByRegion($region_id)
{
    return $this->getQuery()
        ->where('g_officers.region_id', $region_id);
}
public function getFilterGOfficerByDistrict($district_id)
{
    return $this->getQuery()
        ->where('g_officers.district_id', $district_id);
}

//public function filterGOfficer($inputs)
//{
//
//    if (isset($inputs['region']) and $inputs['districts']== null)
//    {
//        $get_filtered_g_officers_by_region = $this->getFilteredGofficerByRegion($inputs['region'])->get();
//        return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportBeneficiaries($get_filtered_g_officers_by_region), 'Beneficiaries List.xlsx');
//
//
//    }
//    if (isset($inputs['districts']))
//    {
//        $get_filtered_g_officers_by_district =  $this->getFilterGOfficerByDistrict($inputs['districts'])->get();
//        return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportBeneficiaries($get_filtered_g_officers_by_district), 'Beneficiaries List.xlsx');
//
//
//    }
//}

}
