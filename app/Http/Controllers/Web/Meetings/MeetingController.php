<?php

namespace App\Http\Controllers\Web\Meetings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Meet\Meet;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class MeetingController extends Controller
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
       
        $internal = Meet::all()->where('user', "Internal");
        $external = Meet::all()->where('user', "External");

        return view('meetings.index')
       
           
        ->with('internal', $internal)
            ->with('external', $external);
    }

    // public function index()
    // {
    //      $meet = User::all();
    //     return view('meetings.index', ["meet" => $meet]);
        
    // }

    public function create()
    {
        $meet = Meet::all();
     
        return view('meetings.create');
       
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'name'=>'required',
            'mobile_number' => 'required',
            'registration_name' => 'required',
            'work_place' => 'required',
            'title' => 'required',
            'district_name' => 'required',
            'user' => 'required',
            'status' =>  'required',
            
           

       ]);


        $meet = new Meet;
        $meet->name = $request->input('name');
        $meet->mobile_number = $request->input('mobile_number');
        $meet->registration_name = $request->input('registration_name ');
        $meet->work_place = $request->input('work_place');
        $meet->title = $request->input('title');
        $meet->user = $request->input('user');
        $meet->district_name = $request->input('district_name');
        $meet->status = $request->input('status');
        $meet->save();
      
        return redirect('meeting')
            ->with('success', 'Stuff Created Successfully');
    }




    public function edit(Meet $meet)
    {
       

        return view('meetings.edit')
        ->with([
           
            'meet'  => $meet
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required',
            'mobile_number' => 'required',
            'registration_name' => 'required',
            'work_place' => 'required',
            'title' => 'required',
            'district_name' => 'required',
            'user' => 'required',
            'status'=>  'required',
        ]);


        $meet  = Meet::find($id);
        $meet->name = $request->input('name');
        $meet->mobile_number = $request->input('mobile_number');
        $meet->registration_name = $request->input('registration_name ');
        $meet->work_place = $request->input('work_place');
        $meet->title = $request->input('title');
        $meet->user = $request->input('user');
        $meet->district_name = $request->input('district_name');
        $meet->status = $request->input('status');
        $meet->save();
     
        return redirect('meeting')
            ->with('success', 'Stuff Updated Successfully');
            
    }



    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if ($validate->fails()) {
            return redirect()->route('meeting.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('meeting.index')->with('success', 'User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function delete($id)
    {
        $meet = Meet::find($id);
        $meet->delete();
        return redirect()->back();
    }

   

}


// $role = Role::create(['name' => 'writer']);
// $permission = Permission::create(['name' => 'edit articles']);


// $role->givePermissionTo($permission);
// $permission->assignRole($role);


// $role->syncPermissions($permissions);
// $permission->syncRoles($roles);



    
  
 
