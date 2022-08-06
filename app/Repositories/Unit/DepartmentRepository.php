<?php

namespace App\Repositories\Unit;

use App\Models\Unit\Department;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DepartmentRepository extends  BaseRepository
{
    const MODEL = Department::class;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('departments.id AS id'),
            DB::raw('departments.title AS title')
        ]);
    }

    public function getActive(){
        return $this->getQuery();
    }

    public function getForSelect(){
        return $this->query()->select([
            DB::raw('departments.id AS id'),
            DB::raw('departments.title AS title')
        ])
            ->pluck('title', 'id');
    }
}


