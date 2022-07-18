<?php

namespace App\Http\Controllers\Web\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver\Driver;
use App\Models\Auth\User;
use App\Models\Fleet\Fleet;

class DriverController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {

        $driver = Driver::all();;
     

        return view('driver.index',compact('driver', $driver));
    }

  

    public function create()
    {
        $driver = Driver::all();
        $users = User::all();
        $fleets = Fleet::all();
        return view('driver.create', ['users' => $users, 'fleets'=>$fleets]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'license_no' => 'required',
            'class_type_of_license' => 'required',
            'user_id' => 'required',
            'license_expiry_date' => 'required',
            'fleet_id' => 'required',

        ]);


        $driver = new Driver;
        $driver->license_no = $request->input('license_no');
        $driver->class_type_of_license = $request->input('class_type_of_license');
        $driver->user_id = $request->input('user_id');
        $driver->license_expiry_date = $request->input('license_expiry_date');
        $driver->fleet_id = $request->input('fleet_id');
        $driver->save();
      
        return redirect('/driver/index')
            ->with('success', 'Driver Assigned Successfully');
    }




    public function edit(Driver $driver)
    {

        $users = User::all();
        $fleets = Fleet::all();
        return view('driver.edit')
            ->with(['driver'  => $driver])
            ->with(['users' => $users])
            ->with(['fleets' => $fleets]);
        
    }



    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'license_no' => 'required',
            'class_type_of_license' => 'required',
            'user_id' => 'required',
            'license_expiry_date' => 'required',
            'fleet_id' => 'required',

        ]);


        $driver = Driver::find($id);
        $driver->license_no = $request->input('license_no');
        $driver->class_type_of_license = $request->input('class_type_of_license');
        $driver->user_id = $request->input('user_id');
        $driver->license_expiry_date = $request->input('license_expiry_date');
        $driver->fleet_id = $request->input('fleet_id');
        $driver->save();
        return redirect('/driver/index')
        ->with('success', 'Driver Assigned Successfully');

      
       
    }



    

    public function delete($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
        return redirect()->back();
    }

   
}
