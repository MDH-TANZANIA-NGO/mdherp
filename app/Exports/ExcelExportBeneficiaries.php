<?php

namespace App\Exports;

use App\Models\GOfficer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportBeneficiaries implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $g_officer =  GOfficer\GOfficer::all();
        return $g_officer;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Phone',
            'Region',
            'Check Number'
        ];
    }

    public function map($row): array
    {

        return [
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            substr($row->phone, -9),
            $row->region->name,
            $row->check_no

        ];
    }
}
