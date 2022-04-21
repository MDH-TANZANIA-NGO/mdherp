<?php

namespace App\Http\Controllers\Web\Designation;

use App\Http\Controllers\Controller;
use App\Models\Unit\Department;
use App\Models\Unit\Designation;
use App\Models\Unit\Unit;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //

    public function index()
    {

    }
    public function create()
    {

        return view('Designation.forms.create')
            ->with('departments', Department::all()->pluck('title', 'id'));
    }
    public function store(Request $request)
    {
       $insert_unit = Unit::query()->create([
           'name'=> $request['unit'],
           'unit_group_id'=>1,
           'title'=> substr($request['unit'], 3)
       ])->id;

      $insert_designation =  Designation::query()->create([
          'name'=> $request['designation'],
          'unit_id'=> $insert_unit,
          'department_id'=>$request['department']
      ]);

      alert()->success('Designation added Successfully', 'Success');
      return redirect()->back();
    }
    public function edit()
    {

    }
    public function update()
    {

    }

}
