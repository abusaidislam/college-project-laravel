<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DegreeFirstYearStudent;
use App\Models\DegreeSecoundYearStudent;
use App\Models\DegreeThirdYearStudent;
class DegreeStudentPromoteController extends Controller
{
    //
    public function DegreeFirstYearStudentPromote(Request $request)
    {
        $firstYearStudents = DegreeFirstYearStudent::where('session', $request->studentsession2)->get();

        $promoted = false;
        foreach ($firstYearStudents as $student) {
            $existingStudent = DegreeSecoundYearStudent::where('registration_no', $student->registration_no)->first();
            if (!$existingStudent) {
                DegreeSecoundYearStudent::create([
                    'class_id' => 2,
                    'student_name' => $student->name,
                    'roll' => $student->register_roll,
                    'session_year' => $student->session,
                    'registration_no' => $student->registration_no,
                ]);
                $promoted = true;
            }
        }
    
        $message = $promoted ? 'Students promoted successfully!!!' : 'Students already exist';
    
        return redirect('degree-first-year-sudetnts')->with('message', $message);
    }
    public function DegreeSecondYearStudentPromote(Request $request)
    {
        $secondYearStudents = DegreeSecoundYearStudent::where('session_year', $request->studentsession2)->get();

        $promoted = false;
        foreach ($secondYearStudents as $student) {
            $existingStudent = DegreeThirdYearStudent::where('registration_no', $student->registration_no)->first();
            if (!$existingStudent) {
                DegreeThirdYearStudent::create([
                    'class_id' => 2,
                    'student_name' => $student->name,
                    'roll' => $student->roll,
                    'session_year' => $student->session_year,
                    'registration_no' => $student->registration_no,
                ]);
                $promoted = true;
            }
        }
    
        $message = $promoted ? 'Students promoted successfully!!!' : 'Students already exist';
    
        return redirect('degree-secound-year-students')->with('message', $message);
    }
}
