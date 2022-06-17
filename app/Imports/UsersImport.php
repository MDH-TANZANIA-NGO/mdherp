<?php

namespace App\Imports;

use App\Models\Auth\User;
//use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return User
     */
    public function model(array $row)
    {
        return new User([
           'identity_number'=>$row['identity_number'],
            'first_name'=> $row['first_name'],
            'middle_name'=> $row['middle_name'],
            'last_name'=> $row['last_name'],
            'email'=>$row['email'],
            'region_id'=>$row['region_id'],
            'gender_cv_id'=>$row['gender_id'],
            'active'=>true,
            'password'=>bcrypt(strtolower($row['last_name']))
        ]);
    }
}
