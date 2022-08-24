<?php

namespace App\Http\Controllers\Web\Hotel;

//use App\Hotel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Hotel\Datatables\BookingRequestsDatatable;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Service;
use App\Models\Hotel\Vendor;
use App\Models\SafariAdvance\SafariAdvanceHotelSelection;
use App\Models\System\Region;
use App\Repositories\Hotel\HotelRepository;
use App\Repositories\Hotel\VendorRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\System\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    use  BookingRequestsDatatable;
    protected $hotels;
    protected $regions;
    protected $districts;
    protected $vendors;

    public function __construct()
    {
        $this->hotels =  (new HotelRepository());
        $this->regions = (new RegionRepository());
        $this->districts = (new DistrictRepository());
        $this->vendors = (new VendorRepository());
    }
    public function workspace()
    {
        //

        return view('Hotel.workspace');
    }


    public function index()
    {


            return view('Hotel.index')
                ->with('hotels', $this->hotels->getQuery()->get());
    }

    public function hotelRequests()
    {

//        dd($this->hotels->getAllSafariUnbookedHotels()->get());
        return view('Hotel.datatables.booking_requests')
            ->with('hotels', $this->hotels->getAllSafariUnbookedHotels()->get())
        ->with('activity_hotels', $this->hotels->getAllActivityUnbookedHotels()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('Hotel.forms.create')
            ->with('districts', $this->districts->forSelect());
    }

    public function edit($uuid)
    {
        $hotel =  $this->hotels->findByUuid($uuid);
        return view('Hotel.forms.edit')
            ->with('hotel', $hotel)
            ->with('districts', $this->districts->forSelect());
    }


    /**
     * Store a newly created resource in storage.
     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->hotels->store($request);
        alert()->success('Hotel added successfully');

        return redirect()->route('admin.index');
    }

    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Hotel  $hotel
//     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }



    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Hotel  $hotel
//     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $uuid)
    {

        $this->hotels->update($request->all(), $uuid);
        alert()->success('Hotel updated successfully', 'Success');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
//     *
//     * @param  \App\Hotel  $hotel
//     * @return \Illuminate\Http\Response
//     */
    public function destroy($uuid)
    {
        //
        return DB::transaction(function () use ($uuid){
            $this->hotels->findByUuid($uuid)->delete();
            alert()->success('Hotel removed successfully', 'Success');
            return redirect()->back();
        });
    }

    public function createVendor()
    {
        return view('Hotel.forms.owners.create')
            ->with('regions', $this->regions->forSelect());
    }
    public function storeVendor(Request $request)
    {
        $vendor =  Vendor::query()->create($this->inputProcessVendor($request->all()));
        $vendor->services()->sync($request['services']);
        alert()->success('Vendor added successfully','Success');
        return redirect()->back();
//        try {
//            return DB::transaction(function () use ($request){
//                $vendor =  Vendor::query()->create($this->inputProcessVendor($request->all()));
//                $vendor->services()->sync($request['services']);
//                alert()->success('Vendor added successfully','Success');
//                return redirect()->back();
//            });
//        }catch (\Exception $exception){
//            alert()->error('Vendor already Exist', 'Failed');
//            return redirect()->back();
//        }

    }

    public function storeServices(Request $request)
    {
        return DB::transaction(function () use ($request){
            Service::query()->create($this->inputProcessService($request->all()));
            alert()->success('Service added successfully','Services');
            return redirect()->route('admin.vendor');
        });
    }

    public function inputProcessVendor($request)
    {
        return [
            'first_name'=>$request['first_name'],
            'middle_name'=>$request['middle_name'],
            'last_name'=>$request['last_name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'company_name'=>$request['company_name'],
            'tin'=>$request['tin'],
            'region_id'=>$request['region_id'],
            'address'=>$request['address'],
        ];
    }


    public function inputProcessService($inputs)
    {
        return [
            'name'=>$inputs['name']
        ];
    }


    public function vendors()
    {
        return view('Hotel.datatables.vendor')
            ->with('hotels', $this->hotels)
            ->with('vendors', Vendor::query()->get())
            ->with('all_services', Service::query()->get())
            ->with('regions', Region::all()->pluck('name','id'))
            ->with('services', Service::all()->pluck('name', 'id'));
    }
    public function editVendor($id)
    {
        return view('Hotel.forms.owners.edit')
            ->with('vendor', Vendor::query()->find($id))
            ->with('services', Service::all()->pluck('name','id'))
            ->with('regions', Region::all()->pluck('name', 'id'))
            ->with('vendor_services', $this->vendors->getServices($id)->get());

    }
    public function editService($id)
    {
        return view('Hotel.forms.edit_service')
            ->with('service', Service::query()->find($id));
    }
    public function updateService($id, Request $request)
    {
        return DB::transaction(function () use ($id, $request)
        {
            Service::query()->find($id)->update($this->inputProcessService($request->all()));
            alert()->success('Service updated successfully','Success');
            return redirect()->route('admin.vendor');
        });
    }





}
