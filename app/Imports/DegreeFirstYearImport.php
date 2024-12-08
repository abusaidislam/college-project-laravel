<?php

namespace App\Imports;

use App\Models\DegreeFirstYearStudent;
use Maatwebsite\Excel\Concerns\ToModel;

class DegreeFirstYearImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DegreeFirstYearStudent([
            'name'  => $row[0],
            'father_name'  => $row[1],
            'mather_name'  => $row[2],
            'email'  => $row[3],
            'studentclass' => $row[4], 
            'register_roll' => $row[5], 
            'session' => $row[6],
            'photo' => $row[7],
            'roll' => $row[8],
            'registration_no' => $row[9],
            'blood_group' => $row[10],
            'mobile_no' => $row[11],
            'father_mobile' => $row[12],
            'home_dis' => $row[13],
        ]);
    }
}
