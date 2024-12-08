<?php

namespace App\Imports;

use App\Models\DegreeSecoundYearStudent;
use Maatwebsite\Excel\Concerns\ToModel;

class DegreeSecoundYearImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DegreeSecoundYearStudent([
            'session_year'  => $row[0],
            'student_name'  => $row[1],
            'roll'  => $row[2],
            'registration_no'  => $row[3],
            'class_id'  => $row[4],
        ]);
    }
}
