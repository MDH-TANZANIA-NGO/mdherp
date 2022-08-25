<?php

namespace App\Http\Controllers\Api\Hotspot;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\Hotspot\HotspotRepository;
use Illuminate\Http\Request;

class HotspotController extends BaseController
{
    //

    public function __construct()
    {
        $this->hotspots = (new HotspotRepository());
    }

    public function store(Request $request)
    {
        $hotspot = $this->hotspots->returnStore($request->all());
        return $this->sendResponse($hotspot->data, $hotspot->message, $hotspot->code);
    }
}
