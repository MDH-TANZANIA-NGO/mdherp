<?php


namespace App\Repositories\Access;


use App\Models\Auth\Group;
use App\Repositories\BaseRepository;

class GroupRepository extends BaseRepository
{
    const MODEL = Group::class;

    public function getQuery()
    {
        return $this->query()->get();
    }
}
