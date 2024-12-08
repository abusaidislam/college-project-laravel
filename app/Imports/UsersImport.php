<?php

namespace App\Imports;

use App\Models\DRAnalysis;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
   
    public function model(array $row)
    {
        $exploded = explode('/', $row[1]);
        $originalValue = $exploded[0];
        $last7Digits = substr($originalValue, -7);
        $registartionValue = substr($originalValue, 0, -7);
        return new DRAnalysis([
            'exam_roll'  => $row[0],
            'registration_no'  => $registartionValue,
            'session'  => $last7Digits,
            'type'  => $exploded[1],
            'candidate_name'  => $row[2],
            'papercode_name'  => $row[3],
            'examname_year'  => $row[4],
            'collegecode_name'  => $row[5],
            'subjectcode_name'  => $row[6],
        ]);
    }
}
