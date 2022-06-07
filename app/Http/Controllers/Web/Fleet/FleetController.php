<?php

namespace App\Http\Controllers\web\Fleet;

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

    public function index2()
    {

        $active_car = Fleet::all()->where('isactive', "Active");
        $inactive_car = Fleet::all()->where('isactive', "InActive");
       
        return view('fleet.index2')
        ->with('active_car',$active_car)
        ->with('inactive_car', $inactive_car);
    }


    public function createRegister()
    {
         $car = Fleet::all();
        return view('fleet.forms.create');
    }

    public function storeRegister(Request $request)
    {
        $car = array();
        $car ['vehicle_type'] = $request->vehicle_type;
        $car ['maker'] = $request->maker;
        $car ['model'] = $request->model;
        $car ['body_type'] = $request->body_type;
        $car ['year'] = $request->year;
        $car ['color'] = $request->color;
        $car ['origin_country'] = $request->origin_country;
        $car ['fuel_type'] = $request->fuel_type;
        $car ['engine_size'] = $request->engine_size;
        $car ['chasis_no'] = $request->chasis_no;
        $car ['vehicle_reg_no'] = $request->vehicle_reg_no;
        $car ['driver'] = $request->driver;
        $car ['isactive'] = $request->isactive;

        $fleets = DB::table('fleets') ->insert($car);
        //alert()->success('Vehicle Registered Successfully','success');
        return redirect()->back()
            ->with('success', 'Vehicle Registered Successfully');

    }

public function updateRegister(Request $request, $id)
     {
        $car  = Fleet::find($id);
        $car ->vehicle_type = $request->vehicle_type;
        $car ->maker = $request->maker;
        $car ->model= $request->model;
        $car ->body_type= $request->body_type;
        $car ->year = $request->year;
        $car ->color = $request->color;
        $car ->origin_country = $request->origin_country;
        $car ->fuel_type= $request->fuel_type;
        $car ->engine_size = $request->engine_size;
        $car ->chasis_no = $request->chasis_no;
        $car ->vehicle_reg_no = $request->vehicle_reg_no;
        $car ->driver = $request->driver;
        $car ->isactive = $request->isactive;
        $car->save();
       
        return redirect()->back()
            ->with('success', 'Vehicle Updated Successfully');

     }


    public function destroyRegister($id)
    {

        $transport = Fleet::find($id);
        $transport->delete();
        return redirect()->back();
    }

    public function editRegister($id)
    {

        $car = Fleet::where('id', $id)->first();
        return view('fleet.editRegister', compact('car'));
    }

    public function viewRegister($id)
    {

        $car = Fleet::where('id', $id)->first();
        
        return view('fleet.view',compact('car'));
    }

    

}


