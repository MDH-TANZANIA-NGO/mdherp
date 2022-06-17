<?php

namespace App\Http\Controllers\Web\Person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Person\Traits\AddressDatatable;
use App\Models\Employee\Address;
use App\Models\System\District;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use AddressDatatable;
    protected $regions;
    protected $districts;

    public function __construct()
    {
        $this->regions = (new RegionRepository());
        $this->districts = (new DistrictRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('person.address.create')
            ->with('types', code_value()->query()->where('code_id', 6)->pluck('name','id'))
            ->with('regions', $this->regions->getAll()->pluck('name','id'))
            ->with('districts', $this->districts->getAll()->pluck('name','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $district = District::where('id', $request['district_id'])->first();
        Address::create([
            'user_id' => access()->id(),
            'district_id' => $request['district_id'],
            'region_id' => $district->region_id,
            'area_name' => $request['area_name'],
            'house_number' => $request['house_number'],
            'address_type_cv_id' => $request['address_type_cv_id']
        ]);

        return redirect()->route('person.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Address $address)
    {
        return view('person.address.show')
            ->with('types', code_value()->query()->where('code_id', 6)->pluck('name','id'))
            ->with('districts', $this->districts->getAll()->pluck('name','id'))
            ->with('address', $address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $district = District::where('id', $request['district_id'])->first();
        $address->update([
            'district_id' => $request['district_id'],
            'region_id' => $district->region_id,
            'area_name' => $request['area_name'],
            'house_number' => $request['house_number'],
            'address_type_cv_id' => $request['address_type_cv_id']
        ]);

        return redirect()->route('person.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
