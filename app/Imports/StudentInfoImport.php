<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\StudentSession;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentInfoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Create the student record
        $student = new Student([
            'name'  => $row[0],
            'father_name'  => $row[1],
            'mather_name'  => $row[2],
            'email'  => $row[3],
            'depart_id'  => $row[4],
            'department'  => $row[5],
            'studentclass' => $row[6], 
            'class_typeof' => $row[7], 
            'register_roll' => $row[8], 
            'session' => $row[9],
            'photo' => $row[10],
            'roll' => $row[11],
            'registration_no' => $row[12],
            'blood_group' => $row[13],
            'mobile_no' => $row[14],
            'father_mobile' => $row[15],
            'home_dis' => $row[16],
        ]);
    
        $student->save();
        return $student;
    }
    

}