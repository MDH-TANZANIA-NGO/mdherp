<?php

namespace App\Imports;


use App\Models\GOfficer\GOfficer;
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
    public function model(array $row)
    {
        $phone = GOfficer::query()->where('phone', $row['phone'])->get();

        return new GOfficer([
            //
            'first_name'=>$row['first_name'],
            'middle_name'=>$row['middle_name'],
            'last_name'=>$row['last_name'],
            'email'=>$row['email'],
            'region_id'=>$row['region_id'],
            'district_id'=>$row['district_id'],
            'g_scale_id'=>$row['g_scale_id'],
            'phone'=>$row['phone'],
            'password'=> bcrypt(strtolower($row['last_name'])),
        ]);

    }

    public function rules(): array
    {
        return [
            '3' => 'unique:g_officers.phone',
        ];
    }
}
