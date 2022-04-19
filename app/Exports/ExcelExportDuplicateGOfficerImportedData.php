<?php

namespace App\Exports;

use App\Models\GOfficerImportedData;
use App\Repositories\GOfficer\GOfficerImportedDataRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExportDuplicateGOfficerImportedData implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $gofficer_imported_data_repo;

    public function __construct()
    {
        $this->gofficer_imported_data_repo =  (new GOfficerImportedDataRepository());
    }

    public function collection()
    {
        $duplicate_entries =  $this->gofficer_imported_data_repo->getAccessDuplicate()->get();
        return $duplicate_entries;
    }

    public function headings(): array
    {
        return [
            'first_name',
            'middle_name',
            'last_name',
            'phone',
            'region_id'
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

        ];
    }
}
