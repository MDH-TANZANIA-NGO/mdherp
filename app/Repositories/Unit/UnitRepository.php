<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:53 AM
 */

namespace App\Repositories\Unit;


use App\Exceptions\GeneralException;
use App\Models\Unit\Unit;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UnitRepository extends BaseRepository
{
    const MODEL = Unit::class;

    /**
     * @param $unit_id
     * @return int|null
     * get user_account_cv_id
     */
    function getUserAccountCvIdByUnitId($unit_id)
    {
        $user_account_cv_id = NULL;

        switch ($unit_id) {
            case '5':
                /*certification staff*/
                $user_account_cv_id = 13;
                break;
            default:
                /*Import staff*/
                $user_account_cv_id = 12;
                break;

        }

        return $user_account_cv_id;
    }

    public function forSelect()
    {
        return $this->query()->where('isactive', 1)->where('title','<>','COV')->pluck('name', 'id');
    }

    public function forSelectNotHasPayment()
    {
        return $this->query()->where('isactive', 1)->whereNull('payment_id')->pluck('name', 'id');
    }

    /**
     * Store unit
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        return DB::transaction(function () use ($input){
            return $this->query()->create([
                'name' => $input['name'],
                'title' => $input['name'],
                'unit_group_id' => $input['unit_group'],
                'ismobile' => $input['option'],
                'account_id' => $input['account'],
            ]);
        });
    }

    /**
     * update unit
     * @param Unit $unit
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function update(Unit $unit, $input)
    {
        if($unit->name != $input['name']){
            $query = Unit::query()->where('name', $input['name'])->where('id', "<>", $unit->id);
            if($query->count() > 0){
                throw new GeneralException('Unit name has already been used');
            }
        }
        return DB::transaction(function () use ($unit, $input){
            return $unit->update([
                'name' => $input['name'],
                'title' => $input['name'],
                'unit_group_id' => $input['unit_group'],
                'ismobile' => $input['option'],
                'account_id' => $input['account'],
            ]);
        });
    }

    /**
     * All query
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('unit_groups.name AS group_name'),
            DB::raw('units.name AS name'),
            DB::raw("concat_ws(' ',accounts.code,accounts.name) as account"),
            DB::raw('units.ismobile AS ismobile'),
            DB::raw('units.isactive AS isactive'),
            DB::raw('units.id AS id'),
        ])
            ->join('unit_groups', 'unit_groups.id', 'units.unit_group_id')
            ->leftjoin('accounts', 'accounts.id', 'units.account_id');
    }

    public function getForDatatables()
    {
        return $this->getQuery();
    }

}
