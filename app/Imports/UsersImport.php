<?php

namespace App\Imports;

use App\Models\Auth\User;
//use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return User
     */
    public function model(array $row)
    {
        return new User([
           'identity_number'=>$row['employee_no'],
            'first_name'=> $row['first_name'],
            'middle_name'=> $row['middle_name'],
            'email'=>$row['email'],
            'dob'=>$row['dob'],
            'employed_date'=>$row['employed_date'],
            'region_id'=>$row['region_id'],
            'gender_cv_id'=>$row['gender_id'],
            'active'=>true,
        ]);
    }
}
