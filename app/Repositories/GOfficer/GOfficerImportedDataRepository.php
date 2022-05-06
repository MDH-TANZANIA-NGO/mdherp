<?php

namespace App\Repositories\GOfficer;

use App\Models\GOfficer\GofficerImportedData;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GOfficerImportedDataRepository extends  BaseRepository
{
    const  MODEL = GofficerImportedData::class;

    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('gofficer_imported_data.id AS id'),
            DB::raw('gofficer_imported_data.first_name AS first_name'),
            DB::raw('gofficer_imported_data.last_name AS last_name'),
            DB::raw('gofficer_imported_data.phone AS phone'),
            DB::raw("CONCAT_WS(', ',gofficer_imported_data.last_name, gofficer_imported_data.first_name) AS names"),
            DB::raw("CONCAT_WS(', ',gofficer_imported_data.last_name, gofficer_imported_data.first_name, gofficer_imported_data.phone) AS unique"),
            DB::raw('gofficer_imported_data.uuid AS uuid'),
            DB::raw('gofficer_imported_data.region_id AS region_id'),
            DB::raw('gofficer_imported_data.check_no as check_no'),
            DB::raw('gofficer_imported_data.fingerprint_data as fingerprint_data'),
            DB::raw('gofficer_imported_data.fingerprint_length as fingerprint_length'),
        ]);

}

public function getAccessImportedData()
{
    return$this->getQuery()
        ->where('gofficer_imported_data.user_id', access()->user()->id)
        ->where('gofficer_imported_data.uploaded', false);
}
public function getAccessDuplicate()
{
    return $this->getQuery()
        ->where('gofficer_imported_data.user_id', access()->user()->id)
        ->where('gofficer_imported_data.uploaded', false)
        ->whereHas('gOfficer');
}
public function getAccessUploadedSuccessfully()
{
    return $this->getQuery()
        ->where('gofficer_imported_data.user_id', access()->user()->id)
        ->where('gofficer_imported_data.uploaded', true)
        ->whereHas('gOfficer');
}
public function getUploadedNotConfirmed()
{
        return $this->getQuery()
            ->where('gofficer_imported_data.user_id', access()->user()->id)
            ->whereDoesntHave('gOfficer');
}

}
