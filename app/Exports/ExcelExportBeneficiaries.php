<?php

namespace App\Exports;

use App\Models\GOfficer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportBeneficiaries implements FromCollection, WithHeadings, WithMapping
{
    protected $g_officers;
    public function __construct($get_g_officers)
    {

        $this->g_officers = $get_g_officers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return $this->g_officers;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Phone',
            'Region',
            'District',
            'Scale',
            'Check Number',
            'region_id',
            'district_id',
        ];
    }

    public function map($row): array
    {
    if ($row->district_id ==  null)
    {

        return [
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            substr($row->phone, -9),
            $row->region->name,
            $row->district_id,
            $row->g_scale_id,
            $row->check_no,
             $row->region_id,

        ];
    }
    if ($row->district_id !=  null)
    {
        return [
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            substr($row->phone, -9),
            $row->region->name,
            $row->district->name,
            $row->g_scale_id,
            $row->check_no,
            $row->region_id,
            $row->district_id,

        ];
    }

    }
}
