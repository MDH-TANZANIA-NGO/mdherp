<?php

namespace App\Http\Controllers\Web\Person\Traits;

use App\Models\Employee\Address;
use App\Models\Employee\Family;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

trait FamilyDatatable
{
    public function allDatatables(){
        $data = Family::where('user_id', access()->id())
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('relationship', function(Family $family){
                $relationship = DB::table('code_values')
                    ->where('id', $family->relationship_cv_id )
                    ->pluck('name');
                return ucfirst($relationship[0]);
            })
            ->editColumn('is_next_of_kin', function($query){
                if ($query->is_next_of_kin == true){
                    return "Yes";
                }
                return "No";
            })
            ->editColumn('name', function($query){
                return ucwords(strtolower($query->name));
            })
            ->editColumn('is_emergency', function($query){
                if ($query->is_emergency == true){
                    return "Yes";
                }
                return "No";
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('person.family.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);
    }

}
