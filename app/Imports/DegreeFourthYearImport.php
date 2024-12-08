<?php

namespace App\Imports;

use App\Models\DegreeFourthYearStudent;
use Maatwebsite\Excel\Concerns\ToModel;

class DegreeFourthYearImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DegreeFourthYearStudent([
            'session_year'  => $row[0],
            'student_name'  => $row[1],
            'roll'  => $row[2],
            'registration_no'  => $row[3],
            'class_id'  => $row[4],
        ]);
    }
}
