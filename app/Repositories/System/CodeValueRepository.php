<?php

namespace App\Repositories\System;

use App\Models\System\CodeValue;
use App\Repositories\BaseRepository;
use App\Repositories\Stakeholder\AssociationsRepository;
use App\Repositories\System\CountryRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

/**
 * Class CodeValueRepository
 * @package App\Repositories\Sysdef
 * @description Use this class with care, could break the system.
 * Controls all the data dictionaries of the system.
 * @author Hamis Hamis
 */
class CodeValueRepository extends BaseRepository
{

    const MODEL = CodeValue::class;
    protected $code_repo;

    /*
     * CodeValueRepository Constructor
     */
    public function __construct(){
        $this->code_repo = new CodeRepository();
    }

    /*
     * Translate CodeValues Entries using lang>code_value
     */
    public function mapIdsForLang($query)
    {
        $return = $query->map(function ($item, $key) {
            return ['id' => $item['id'], 'name' => __("code_value." . $item['id'])];
        });
        return $return;
    }

    /**
     * Get code value name for translation
     * @param $id
     * @return array|null|string
     */
    public function name($id)
    {
        return __('code_value.'. $id);
    }
    /*
     *
     */
    public function getUserLogTypeLogIn()
    {
        $return = $this->query()->select(['id'])->where("code_id", 3)->where("reference", "ULLGI")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeLogOut()
    {
        $return = $this->query()->select(['id'])->where("code_id", 3)->where("reference", "ULLGO")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeFailedLogin()
    {
        $return = $this->query()->select(['id'])->where("code_id", 3)->where("reference", "ULFLI")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypePasswordReset()
    {
        $return = $this->query()->select(['id'])->where("code_id", 3)->where("reference", "ULPRS")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeUserLockout()
    {
        $return = $this->query()->select(['id'])->where("code_id", 3)->where("reference", "ULULC")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getPortalUserForSelect()
    {
        $query = $this->query()->select(['id'])->where("code_id", 1)->whereIn("id", [2, 3, 4])->get();
        $return = $this->mapIdsForLang($query)->pluck('name', 'id');
        return $return;
    }

    /*
     *
     */
    public function getCodeForSelectFiltered($code_id, array $filter)
    {
        $query = $this->query()->select(['id'])->where("code_id", $code_id)->whereIn("id", $filter)->get();
        $return = $this->mapIdsForLang($query)->pluck('name', 'id');
        return $return;
    }

    /*
     * Get all code values by code_id
     * For initiating chained selects
     */
    public function getAllByCode($code_id)
    {
        return $this->query()->select(['id', 'name', 'code_id'])->where("code_id", $code_id)->get();
    }

    /*
     *
     */
    public function getCodeForSelect($code_id)
    {
        $query = $this->query()->select(['id'])
            ->where("code_id", $code_id)
            ->orderBy('id', 'asc')
            ->get();
        $return = $this->mapIdsForLang($query)->pluck('name', 'id');
        return $return;
    }

    public function getCodeForSelectWithNoLang($code_id)
    {
        $query = $this->query()
            ->where("code_id", $code_id)
            ->orderBy('id', 'asc')
            ->pluck('name','id');
        $return = $query;
        return $return;
    }

    /*
     *
     */
    public function getCodeValuesByReferenceForSelect($id)
    {
        $query = $this->query()->select(['name', 'reference'])->where("code_id", $id)->get();
        $return = $query->pluck("name", "reference");
        return $return;
    }

    /**
     * Get CV by reference
     * @param $reference
     * @return mixed
     */
    public function getCodeValueByReference($reference){
        return $return = $this->query()->where("reference", $reference)->first();
    }

    /*
     *
     */
    public function getCodeValues($code_id)
    {
        return $this->query()->where("code_id", $code_id)->get();
    }

    /*
     * Get instances of all logistic services for tendering - Business center
     */
    public function getCodeValuesNotIn($code_id, array $id)
    {
        return $this->query()->where("code_id", $code_id)->whereNotIn('id', $id)->get();
    }

    /*
     *
     */
    public function getCodeValuesPaginate($code_id, $count = 10)
    {
        return $this->query()->where("code_id", $code_id)->paginate($count);
    }

    /*
     *
     */
    public function getCurrencyForSelect(){
        $repo = new CurrencyRepository();
        $query = $repo->query()->select(['id', 'code'])->get();
        $return = $query->pluck("code", "id");
        return $return;
    }

    /*
     *
     */
    public function getCountryForSelect()
    {
        $repo = new CountryRepository();
        $query = $repo->query()->select(['name', 'code'])->get();
        $return = $query->pluck("name", "name");
        return $return;
    }

    /*
     *
     */
    public function getCountryIdsForSelect()
    {
        $repo = new CountryRepository();
        $query = $repo->query()->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }

    /*
     *
     */
    public function getRegionForSelect()
    {
        $repo = new RegionRepository();
        $query = $repo->query()->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }


    public function getDistrictForSelect()
    {
        $repo = new DistrictRepository();
        $query = $repo->query()->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }

    /*
     * Get Code instance from code_id
     */
    public function getCodeInstanceById($code_id)
    {
        return $this->code_repo->find($code_id);
    }

    /*
     * Get code values by code for data table
     */
    public function getCodeValuesByCodeForDataTable($code_id){
        return $this->query()->where('code_id', $code_id);
    }






    /*--------end logistic service for tender*/
    /**
     * get the maximum number of sort of a given code value
     * @param $code_id
     * @return mixed
     */
    public function getMaxSort($code_id){
        $code_values = $this->query()->select('sort')
            ->where('code_id', $code_id)
            ->orderBy('sort', 'desc')
            ->first();
        return $code_values->sort;
    }

    /**
     * generate references for CodeValue
     * @param $initials
     * @return string
     */
    public function generateReference($initials){
        do
        {
            $token = randomString();
            $reference = $initials.$token;
            $available = $this->query()
                ->select('reference')
                ->where('reference', $reference)->get();
        }
        while(!$available->isEmpty());
        return $reference;
    }


    /**
     * @param $cv_id
     * Get subcategory code of the code value
     */
    public function getCodeCategory($cv_id)
    {
               $code_value = $this->find($cv_id);
        $code_category = $code_value->codes()->where('iscategory', 1)->first();
        return $code_category;
    }



    /**
     * Store Code Value
     * @param array $input
     * @param $code_id
     */
    public function store(array $input, $code_id){
        $status = $input['status'];
        $isactive = 0;

        if($status == 'yes'){
            $isactive = 1;
        }

        $sort = $this->getMaxSort(23);

        DB::transaction(function () use ($input, $isactive, $sort, $code_id) {
            $query = $this->query()->create([
                'name' => $input['name'],
                'description' => $input['content'],
                'code_id' => $code_id,
                'reference' => $this->generateReference('FT'),
                'isactive' => $isactive,
                'sort' => ++$sort,
            ]);
            return $query;
        });
    }

    /**
     * @param array $input
     * @param $reference
     */
    public function update(array $input, $reference){
        $status = $input['status'];
        $isactive = 0;

        if($status == 'yes'){
            $isactive = 1;
        }

        DB::transaction(function () use ($input, $isactive, $reference) {
            $query = $this->find($reference->id);
            $query->name = $input['name'];
            $query->description = $input['content'];
            $query->isactive = $isactive;
            $query->update();
            return $query;
        });
    }

    /**
     * a function that relates a code value id with the font-awesome icon
     */
    public function cvIcon($id)
    {
        switch ($id) {
            case 129: {
                //vehicles
                $icon = '<i class=" fas fa-truck"></i>';
            }; break;
            case 130: {
                //containers
                $icon = '<i class="fas fa-archive"></i>';
            }; break;
            default: {
                //others
                $icon = '<i class="fas fa-searchengin"></i>';
            }
        }

        return $icon;
    }
}
