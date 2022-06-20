<?php

namespace App\Http\Controllers\web\fleet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Fleet\Traits\FleetDatatables;
use App\Models\Fleet\Fleet;
use App\Repositories\Fleet\FleetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        $data = array();
        $data['vehicle_type'] = $request->vehicle_type;
        $data['maker'] = $request->maker;
        $data['model'] = $request->model;
        $data['body_type'] = $request->body_type;
        $data['year'] = $request->year;
        $data['color'] = $request->color;
        $data['origin_country'] = $request->origin_country;
        $data['fuel_type'] = $request->fuel_type;
        $data['engine_size'] = $request->engine_size;
        $data['chasis_no'] = $request->chasis_no;
        $data['vehicle_reg_no'] = $request->vehicle_reg_no;
        $data['driver'] = $request->driver;
        $data['isactive'] = $request->isactive;

        $fleets = DB::table('fleets') ->insert($data);
        //alert()->success('Vehicle Registered Successfully','success');
        return redirect()->back()
            ->with('success', 'Vehicle Registered Successfully');

    }

}

