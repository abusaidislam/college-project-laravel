<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentHonoursSecoundYear;
use App\Models\StudentHonoursThirdYear;
use App\Models\StudentHonoursFourthYear;
use Illuminate\Support\Facades\Session;
class HonoursStudentPromoteController extends Controller
{
    public function HonoursSecondYearStudentPromote(Request $request)
{
    $firstYearStudents = Student::where('session', $request->studentsession2)->get();
    $depart_id = Session::get('depart_id');
    
    $promoted = false;

    foreach ($firstYearStudents as $student) {
        $existingStudent = StudentHonoursSecoundYear::where('registration_no', $student->registration_no)->first();

        if (!$existingStudent) {
            StudentHonoursSecoundYear::create([
                'depart_id' => $student->depart_id,
                'class_id' => 2,
                'class_typeof' => 1,
                'student_name' => $student->name,
                'roll' => $student->register_roll,
                'session_year' => $student->session,
                'registration_no' => $student->registration_no,
            ]);
            $promoted = true;
        }
    }

    $message = $promoted ? 'Students promoted successfully!!!' : 'Students already exist';

    return redirect('honours-first-year-students')->with('message', $message);
}
    public function HonoursThirdYearStudentPromote(Request $request)
{
    $secondYearStudents = StudentHonoursSecoundYear::where('session_year', $request->studentsession2)->get();
    $depart_id = Session::get('depart_id');
    
    $promoted = false;
    foreach ($secondYearStudents as $student) {
        $existingStudent = StudentHonoursThirdYear::where('registration_no', $student->registration_no)->first();
        if (!$existingStudent) {
            StudentHonoursThirdYear::create([
                'depart_id' => $student->depart_id,
                'class_id' => 3,
                'class_typeof' => 1,
                'student_name' => $student->student_name,
                'roll' => $student->roll,
                'session_year' => $student->session_year,
                'registration_no' => $student->registration_no,
            ]);
            $promoted = true;
        }
    }
    $message = $promoted ? 'Students promoted successfully!!!' : 'Students already exist';
    return redirect('honours-secound-year-students')->with('message', $message);
}
    public function HonoursFourthYearStudentPromote(Request $request)
{
    $thirdYearStudents = StudentHonoursThirdYear::where('session_year', $request->studentsession2)->get();
    $depart_id = Session::get('depart_id');
    
    $promoted = false;

    foreach ($thirdYearStudents as $student) {
        $existingStudent = StudentHonoursFourthYear::where('registration_no', $student->registration_no)->first();

        if (!$existingStudent) {
            StudentHonoursFourthYear::create([
                'depart_id' => $student->depart_id,
                'class_id' => 4,
                'class_typeof' => 1,
                'student_name' => $student->student_name,
                'roll' => $student->roll,
                'session_year' => $student->session_year,
                'registration_no' => $student->registration_no,
            ]);
            $promoted = true;
        }
    }

    $message = $promoted ? 'Students promoted successfully!!!' : 'Students already exist';

    return redirect('honours-third-year-students')->with('message', $message);
}

}
