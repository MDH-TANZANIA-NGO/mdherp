<?php

namespace App\Imports;


use App\Models\GOfficer\GOfficer;
use App\Repositories\GOfficer\GOfficerRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GOfficersImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return GOfficer
     */

    protected $g_officer_repo;

    public function __construct()
    {
        $this->g_officer_repo = (new GOfficerRepository());
    }
    public function model(array $row)
    {
/*//        $phone = GOfficer::query()->where('phone', $row['phone'])->get();
        $year = substr($row['year'], -2);
        $month = $row['month'];
        $region_id = $row['region_id'];
        $id = $row['id'];
        $number =$region_id.'-'.$month.'-'.$year.'-'.$id;*/

        return new GOfficer([
            //
            'first_name'=>$row['first_name'],
            'middle_name'=>$row['middle_name'],
            'last_name'=>$row['last_name'],
//            'email'=>$row['email'],
            'region_id'=>$row['region_id'],
//            'district_id'=>$row['district_id'],
//            'g_scale_id'=>$row['g_scale_id'],
            'phone'=> '255'.substr($row['phone'], -9),
//            'phone2'=>'255'.substr($row['phone2'], -9),
            'password'=> bcrypt(strtolower($row['last_name'])),
            'fingerprint_data'=> $this->g_officer_repo->getDefaultFingerprints(),
            'fingerprint_length'=> $this->g_officer_repo->getFingerprintLength(),
            'check_no'=>'0'.$row['region_id'].'-'.'0'.$row['month'].'-'.substr($row['year'], -2).'-'.$row['id'],
        ]);




    }

    public function rules(): array
    {
        return [
            '3' => 'unique:g_officers.phone',
        ];
    }
}
