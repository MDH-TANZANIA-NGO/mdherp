<?php

namespace App\Repositories\Access;

use App\Models\Auth\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    const MODEL = Role::class;

    public function getPublic()
    {
        return $this->query()->select(['id', 'name'])->where("isadministrative", 0)->orderBy("id", "asc")->get();
    }

    public function  getDetail($id){

        $role = $this->query()->where('id', $id)->first();
        return $role;
    }

    public function forSelect()
    {
        return $this->query()->where('isactive', 1)->where('isfree', 1)->pluck('name', 'id');
    }



}
