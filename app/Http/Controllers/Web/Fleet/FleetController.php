<?php

namespace App\Http\Controllers\web\fleet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Fleet\Traits\FleetDatatables;
use App\Models\Fleet\Fleet;
use App\Repositories\Fleet\FleetRepository;
use Illuminate\Http\Request;
class FleetController extends Controller
{
    use FleetDatatables;
    protected $fleets;
    /**
     * @var FleetRepository
     */

    public function __construct()
    {
        $this->fleets = (new FleetRepository());
    }

    public function index()
    {
        return view('fleet.index');
    }

    public function create()
    {
        return view('fleet.forms.create');
    }

    public function store()
    {
        //store here
    }

}

