<?php

namespace App\Imports;

use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GofficerImportedData;
use App\Repositories\GOfficer\GOfficerRepository;
use Dotenv\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GOfficerImportedTemporaryData implements ToModel, WithHeadingRow, ToCollection
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $g_officer_repo;
    public $data;

    public function __construct($file_name)
    {
        $this->g_officer_repo = (new GOfficerRepository());
        $this->file_name =  $file_name;

    }
    public function model(array $row)
    {



        return new GofficerImportedData([

            'first_name'=>$row['first_name'],
            'middle_name'=>$row['middle_name'],
            'last_name'=>$row['last_name'],
            'region_id'=>$row['region_id'],
            'gender_cv_id'=>$row['gender_cv_id'],
            'government_scale_id'=>$row['government_scale_id'],
            'district_id'=>$row['district_id'],
            'phone'=> '255'.substr($row['phone'], -9),
            'password'=> bcrypt(strtolower($row['last_name'])),
            'fingerprint_data'=> $this->g_officer_repo->getDefaultFingerprints(),
            'fingerprint_length'=> $this->g_officer_repo->getFingerprintLength(),
            'check_no'=>'0'.$row['region_id'].'-'.'0'.$row['month'].'-'.substr($row['year'], -2).'-'.rand(1, 200000),
            'user_id'=>access()->user()->id,
            'file_name'=>$this->file_name
        ]);
    }

    public function collection(Collection $collection)
    {
        // TODO: Implement collection() method.


        $data = $this->data;

    }
}
