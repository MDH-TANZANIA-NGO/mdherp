<?php

namespace App\Repositories\Hotel;

use App\Models\Hotel\Vendor;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class VendorRepository extends BaseRepository
{
    const MODEL = Vendor::class;
    public function __construct()
    {
        //
    }

    public function getQuery()
    {
        return $this->query()->select([
//            DB::raw('id AS id'),
            DB::raw('vendors.company_name AS company_name'),
             DB::raw('vendors.id AS vendor_id'),
//              DB::raw('services.id AS service_id'),
              DB::raw('services.name AS service_name'),
            DB::raw('service_vendor.service_id AS service_id')
        ]);
    }
    public function getServices($vendor_id)
    {
        return $this->getQuery()
            ->leftjoin('service_vendor','service_vendor.vendor_id', 'vendors.id')
            ->leftjoin('services','services.id','service_vendor.service_id')
            ->where('service_vendor.vendor_id', $vendor_id);
    }

}
