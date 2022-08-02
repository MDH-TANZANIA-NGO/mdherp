<?php

namespace App\Exports;

use App\Models\GOfficer\GOfficer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BeneficiaryFilteredExport implements FromCollection,  WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $g_officers;
    public function __construct($get_g_officers)
    {

        $this->g_officers = $get_g_officers;

    }
    public function collection()
    {

        return $this->g_officers;
    }
    public function headings(): array
    {
        return [
            'first_name',
            'middle_name',
            'last_name',
            'phone',
            'region_id',
            'district_id',
            'g_scale_id',
            'check_no',
            'gender_cv_id',
            'is_government_employed',
            'government_scale_id',
            'referenced_uuid',
        ];
    }
    public function map($row): array
    {

        return [
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            substr($row->phone, -9),
            $row->region_id,
            $row->district_id,
            $row->g_scale_id,
            $row->check_no,
            $row->gender_cv_id,
            $row->is_government_employed,
            $row->government_scale_id,
            $row->uuid,

        ];
    }
}
