<?php


namespace App\Repositories\Access;


use App\Models\Auth\Permission;
use App\Repositories\BaseRepository;


class PermissionRepository extends BaseRepository
{

    const  MODEL = Permission::class;

    public  function  getAll()
    {
        return $this->query()->select(['id', 'display_name','description'])->where("ischecker", 1)->get();
    }

}
