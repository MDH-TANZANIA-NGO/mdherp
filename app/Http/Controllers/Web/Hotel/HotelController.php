<?php

namespace App\Http\Controllers\Web\Hotel;

//use App\Hotel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Hotel\Datatables\BookingRequestsDatatable;
use App\Models\Hotel\Vendor;
use App\Models\SafariAdvance\SafariAdvanceHotelSelection;
use App\Repositories\Hotel\HotelRepository;
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

    public function __construct()
    {
        $this->hotels =  (new HotelRepository());
        $this->regions = (new RegionRepository());
        $this->districts = (new DistrictRepository());
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
     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Hotel  $hotel
//     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
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
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
//     *
//     * @param  \App\Hotel  $hotel
//     * @return \Illuminate\Http\Response
//     */
    public function destroy(Hotel $hotel)
    {
        //
    }

    public function createVendor()
    {
        return view('Hotel.forms.owners.create')
            ->with('regions', $this->regions->forSelect());
    }
    public function storeVendor(Request $request)
    {
        return DB::transaction(function () use ($request){
            return Vendor::query()->create([
                'first_name'=>$request['first_name'],
                'middle_name'=>$request['middle_name'],
                'last_name'=>$request['last_name'],
                'phone'=>$request['phone'],
                'email'=>$request['email'],
                'region_id'=>$request['region_id'],
                'address'=>$request['address'],
            ]);
        });
    }

}
