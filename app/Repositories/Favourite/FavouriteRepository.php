<?php

namespace App\Repositories\Favourite;

use App\Models\Favourite\Favourite;
use App\Repositories\BaseRepository;

class FavouriteRepository extends  BaseRepository
{
    const MODEL = Favourite::class;
    public function __construct()
    {
        //
    }
}
