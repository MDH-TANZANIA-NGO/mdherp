<?php

namespace App\Http\Controllers\Web\Person\Traits;

use App\Models\Employee\Address;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

trait AddressDatatable
{
    public function allDatatables(){
        $data = Address::where('user_id', access()->id())
            ->with('region')
            ->with('district')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('address_type', function(Address $address){
                $addressType = DB::table('code_values')
                    ->where('id', $address->address_type_cv_id )
                    ->pluck('name');
                return $addressType[0];
            })
            ->addColumn('region', function(Address $address){
                return $address->region->name;
            })
            ->addColumn('district', function(Address $address){
                return $address->district->name;
            })
            ->addColumn('action', function($query) {
                return '<a href="'.route('person.address.show', $query->uuid).'">View</a>';
            })
            ->rawColumns(['action','type'])
            ->make(true);
    }
}
