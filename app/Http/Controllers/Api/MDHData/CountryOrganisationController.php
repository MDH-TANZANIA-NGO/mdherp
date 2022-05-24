<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryOrganisationController extends BaseController
{
    public function index(){

        $countries_organisations = DB::table("country_organisation")
            ->selectRaw('country_organisation.id as id, countries.name as country, organisations.name as organisation')
            ->leftJoin('organisations', 'organisations.id', '=', 'organisation_id')
            ->leftJoin('countries', 'countries.id', '=', 'country_id')
            ->get();

        $success['countries_organisations'] = $countries_organisations;
        return $this->sendResponse($success, 'all organisations countries');
    }

    public function getCountry($id)
    {
        $country_organisation = DB::table("country_organisation")
            ->where('country_organisation.id', $id)->first();

        $success['country_organisation'] = $country_organisation;
        return $this->sendResponse($success, 'Country Organisation');
    }
}
