<?php

namespace App\Http\Controllers;
use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\DegreeFirstYearStudent;
use App\Models\DegreeSecoundYearStudent;
use App\Models\DegreeThirdYearStudent;
use App\Models\DegreeFourthYearStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\DegreeCourse;
use App\Models\LibraryLogo;
use App\Models\DegreeClass;

class DegreeConsolidatedResultFinalYearController extends Controller
{
 


 public function allresult()
    {   $depart_id =Session::get('depart_id'); 
       $depart_name = Session::get('depart_name');
        $data = DB::table('student_results')->where('depart_id', '=', $depart_id)->groupBy('name')->get();

        Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
         $studentResult = StudentResult::where('depart_id', '=', $depart_id)->groupBy('years')->get();
     return view('backend.result', compact('data','studentResult'));
      }

    public function findresult($id,$years)
    {
      $studentResult = StudentResult::where('student_id', '=', $id)->where('years', '=', $years)->get();
      return $marks=sum($studentResult->marks);
      //return response()->json($studentclass);
    }

    public function degree_consolidated_result($registration_no)
    {

      $studentInfos = DegreeFirstYearStudent::where('registration_no', $registration_no)->first();
      $student1stInfo = DegreeFirstYearStudent::where('registration_no', $registration_no)->first();
      $student2ndInfo = DegreeSecoundYearStudent::where('registration_no',$registration_no)->first();
      $student3rdInfo = DegreeThirdYearStudent::where('registration_no',$registration_no)->first();                     
      $student4thInfo = DegreeFourthYearStudent::where('registration_no',$registration_no)->first();
  
      $stuinfo = DB::table('degree_third_year_students')  
      ->where('id', $student3rdInfo->id)
      ->where('class_id', $student3rdInfo->class_id)
      ->first();
     $examyear= DB::table('degree_student_results')  
          ->where('student_id', $stuinfo->id)
          ->where('class_id', $stuinfo->class_id)
          ->where('student_class_year', $stuinfo->session_year)
          ->first();
   
     $TotalCredit = DegreeCourse::orderBy('name','asc')->get();
     //first year
     $CourseInfo1stYear = DB::table('degree_first_year_students')
                                      ->where('degree_first_year_students.registration_no', $student1stInfo->registration_no)
                                      ->where('degree_first_year_students.studentclass', $student1stInfo->studentclass)
                                      ->join('degree_courses', 'degree_first_year_students.studentclass', '=', 'degree_courses.class_id')
                                      ->select('degree_first_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
                                      ->get();          
     //second year                                 
     $CourseInfo2ndYear = DB::table('degree_secound_year_students')
                                      ->where('degree_secound_year_students.registration_no', $student2ndInfo->registration_no)
                                      ->where('degree_secound_year_students.class_id', $student2ndInfo->class_id)
                                      ->join('degree_courses', 'degree_secound_year_students.class_id', '=', 'degree_courses.class_id')
                                      ->select('degree_secound_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
                                      ->get();
     //third year        
      $CourseInfo3rdYear = DB::table('degree_third_year_students')
                                  ->where('degree_third_year_students.registration_no', $student3rdInfo->registration_no)
                                  ->where('degree_third_year_students.class_id', $student3rdInfo->class_id)
                                  ->join('degree_courses', 'degree_third_year_students.class_id', '=', 'degree_courses.class_id')
                                  ->select('degree_third_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
                                  ->get();

      return view('backend.degree_consolidated_final_result', compact('TotalCredit','studentInfos','CourseInfo1stYear','CourseInfo2ndYear','CourseInfo3rdYear','examyear'));
    }
    
  
}
