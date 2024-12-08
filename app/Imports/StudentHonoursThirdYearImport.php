<?php

namespace App\Imports;

use App\Models\StudentHonoursThirdYear;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentHonoursThirdYearImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StudentHonoursThirdYear([
            'session_year'  => $row[0],
            'student_name'  => $row[1],
            'roll'  => $row[2],
            'registration_no'  => $row[3],
            'class_id'  => $row[4],
            'depart_id'  => $row[5],
            'class_typeof' => $row[6], 
        ]);
    }
}
