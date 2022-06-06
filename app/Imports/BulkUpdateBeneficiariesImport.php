<?php

namespace App\Imports;

use App\Models\GOfficer\GofficerImportedData;
//use App\Models\GOfficer\GOfficerImportedData;
use App\Repositories\GOfficer\GOfficerRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BulkUpdateBeneficiariesImport implements ToModel, WithHeadingRow, ToCollection, WithBatchInserts
{
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
        return new GOfficerImportedData([
            //
            'first_name'=>$row['first_name'],
            'middle_name'=>$row['middle_name'],
            'last_name'=>$row['last_name'],
            'region_id'=>$row['region_id'],
            'phone'=> '255'.substr($row['phone'], -9),
            'password'=> bcrypt(strtolower($row['last_name'])),
            'fingerprint_data'=> $this->g_officer_repo->getDefaultFingerprints(),
            'fingerprint_length'=> $this->g_officer_repo->getFingerprintLength(),
            'district_id'=>$row['district_id'],
            'check_no'=>$row['check_no'],
            'government_scale_id'=>$row['government_scale_id'],
            'g_scale_id'=>$row['g_scale_id'],
            'is_government_employed'=>$row['is_government_employed'],
            'referenced_uuid'=>$row['referenced_uuid'],
            'user_id'=>access()->user()->id,
            'file_name'=>$this->file_name
        ]);
    }
    public function collection(Collection $collection)
    {
        // TODO: Implement collection() method.


        $data = $this->data;

    }

    public function batchSize(): int
    {
        return 100;
    }


}
