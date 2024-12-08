<?php

namespace App\Http\Controllers;


use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\DegreeStudentResult;
use App\Models\DegreeFirstYearStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\StudentSession;
use App\Models\LibraryLogo;
use App\Models\marks;
use App\Models\DegreeCourse;

class DegreeResultFirstYearStudentController extends Controller
{
    public function index()
    {
        $classname    = DegreeClass::all();
        $CourseName   = DegreeCourse::orderBy('id','asc')->first();
        $Course   = DegreeCourse::where('class_id', '=', $CourseName->class_id)->orderBy('id','asc')->get();
        $studentclass = DegreeClass::where('id', '=', 1)->first();
        $Student      = DegreeFirstYearStudent::where('studentclass',1)->latest()->get();
        $studentSession   = DegreeFirstYearStudent::select('session')->where('studentclass',1)->orderBy('session','desc')->distinct()->get();
        $StudentResult = DegreeStudentResult::where('class_id',1)->latest()->get();
        $Studentlist      = DegreeFirstYearStudent::all();
        return view('backend.degreefirstyear_result', compact('Course','StudentResult','Studentlist','Student','CourseName','classname','studentclass','studentSession'));
      }

    public function store(Request $request) { 

      $name = $request->name;
      $student_id = $request->sid;
      $marks = $request->marks;
      $classId = $request->classId;
      $class_year = $request->student_class_year;
      $year = $request->year;
      $subject = $request->subject;   
      $sub_written_mark = $request->sub_written_mark;
      $dataInserts = [];
      for ($i = 0; $i < count($marks); $i++) {
        $roundedNewMark = $marks[$i] * 100 / $sub_written_mark;
        $newMark =round($roundedNewMark);
          $dataInserts[] = [
              'student_id' => $student_id[$i],
              'subject' => $subject,
              'written_mark' => $marks[$i],
              'marks' => $newMark,
              'name' => $name[$i],
              'years' => $year,
              'class_id' => $classId, 
              'student_class_year' => $class_year, 
          ];
      }
    
      foreach ($dataInserts as $dataInsert) {
    
        DegreeStudentResult::updateOrCreate(
              [
                  'student_id' => $dataInsert['student_id'],
                  'subject' => $dataInsert['subject'],
                  'years' => $dataInsert['years'],
                  'class_id' => $dataInsert['class_id']
              ],
              $dataInsert
          );
      
      }
           
      return redirect('degree-first-year-result')->with('message', 'Inserted successfully!!!');
  }

  
   public function postvalue(Request $request){
    // return($request->all());
        $name = $request->name;
        $student_id = $request->sid;
        $marks = $request->marks;
        $class_id = $request->classId;
        $class_year = $request->student_class_year;
        $year = $request->year;
        $department = $request->department;
        $subject = $request->subject;
        $sub_written_mark = $request->sub_written_mark;
        for ($i=0; $i <count($marks) ; $i++) 
        {
        $roundedNewMark = $marks[$i] * 100 / $sub_written_mark;
        $newMark =round($roundedNewMark);
             $dataInsert =[
                'student_id' => $student_id[$i],
                'subject' => $subject,
                'written_mark' => $marks[$i],
                'marks' => $newMark,
                'name' => $name[$i],
                'years' => $year,
                'class_id' => $class_id,
                'student_class_year' => $class_year, 
                
            ];
        //   StudentResult::create($dataInsert);

        } 
         //return back;
       }

       
       public function degreeFirstYear($id){  
  
        $student_year = DB::table('degree_first_year_students')->where('studentclass', $id)->orderBy('session','desc')->get(); 
        return response()->json($student_year);
   }

 public function searchsubjet($id)
    {   
    
          $studentclass = StudenClass::find($id);
           return $studentclass;


    }

    public function edit($id)
    {
        $data = DegreeStudentResult::find($id);
        return response()->json($data);
    }

    public function getUserbyDegreeFirst(Request $request){
      $userid         = $request->userid;
      $data = explode('/', $userid);  
      $class_id = $data[0]; 
      $class_year = $data[1]; 
      $Students = DB::table('degree_first_year_students')
            ->where('studentclass', $class_id)
            ->where('session', $class_year)
            ->orderBy('register_roll','asc')
            ->get();
      $trList           = [];
      foreach ($Students as $value) {
        $trList[] = '<tr>
        <td align="center">'. $value->id .'</td>
        <td align="center">
         <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->name .'" required="">
         </td> 
         <input type="hidden" name="sid[]" value="'. $value->id .'" >
         <td align="center">
         <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Marks " value="" required="">
         </td>
        </tr>';         
      }
    
      return $trList;
   }
    
    public function destroy($id)
    {
        Student::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }



 public function allresult()
    {   $depart_id =Session::get('depart_id'); 
       $depart_name = Session::get('depart_name');
        $data = DB::table('student_results')->where('depart_id', '=', $depart_id)->groupBy('name')->get();

        Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
         $studentResult = DegreeStudentResult::where('depart_id', '=', $depart_id)->groupBy('years')->get();
     return view('backend.result', compact('data','studentResult'));
      }

    public function findresult($id,$years)
    {
      $studentResult = DegreeStudentResult::where('student_id', '=', $id)->where('years', '=', $years)->get();
      return $marks=sum($studentResult->marks);
      //return response()->json($studentclass);
    }


    public function degreeFirstYearMarksheet($registration_no)
    {

     $studentInfo = DegreeFirstYearStudent::where('registration_no',$registration_no)->first();
     $studentInfos = DegreeFirstYearStudent::where('registration_no', $registration_no)->first();
       $stuinfo = DB::table('degree_first_year_students')  
        ->where('id', $studentInfo->id)
        ->where('studentclass', $studentInfo->studentclass)
        ->first();
      $examyear= DB::table('degree_student_results')  
        ->where('student_id', $stuinfo->id)
        ->where('class_id', $stuinfo->studentclass)
        ->where('student_class_year', $stuinfo->session)
        ->first();                           
    $CourseIn = DB::table('degree_first_year_students')
     ->where('degree_first_year_students.id', $studentInfo->id)
     ->where('degree_first_year_students.studentclass', $studentInfo->studentclass)
     ->join('degree_courses', 'degree_first_year_students.studentclass', '=', 'degree_courses.class_id')
     ->select('degree_first_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
     ->get();
 
      return view('backend.degree_firstyear_marksheet', compact('CourseIn','studentInfos','examyear'));
    }


    public function degreeFirstYearTestimonial($id)
    { 


        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeFirstYearStudent::find($id);
        $resultdata = DegreeStudentResult::find($id);
        $className = DegreeClass::where('id',$ndata->studentclass)->first();
        // $data = DegreeStudentIdCardNote::all();
        $studentInfo = DegreeFirstYearStudent::where('id',$id)->first();
        $CourseIn = DB::table('degree_first_year_students')
        ->where('degree_first_year_students.id', $studentInfo->id)
        ->where('degree_first_year_students.studentclass', $studentInfo->studentclass)
        ->join('degree_courses', 'degree_first_year_students.studentclass', '=', 'degree_courses.class_id')
        ->select('degree_first_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
        ->get();
        $totalGpSum = 0;
        $totalCreditSum = 0;
        $hasFail = false;
    
        foreach ($CourseIn as $item) {
            $studen = DB::table('degree_student_results')
                ->where('student_id', $item->id)
                ->where('subject', $item->course_id)
                ->first();
    
            if ($studen) {
                $marks = $studen->marks;
                $gradPoint = $studen->marks;
                $grade = '';
    
                if ($marks >= 80) {
                    $grade = 'A+';
                } elseif ($marks >= 75) {
                    $grade = 'A';
                } elseif ($marks >= 70) {
                    $grade = 'A-';
                } elseif ($marks >= 65) {
                    $grade = 'B+';
                } elseif ($marks >= 60) {
                    $grade = 'B';
                } elseif ($marks >= 55) {
                    $grade = 'B-';
                } elseif ($marks >= 50) {
                    $grade = 'C+';
                } elseif ($marks >= 45) {
                    $grade = 'C';
                } elseif ($marks >= 40) {
                    $grade = 'D';
                } else {
                    $grade = 'F';
                    $hasFail = true;
                }
    
                $gp = '';
                if ($gradPoint >= 80) {
                    $gp = 4.0;
                } elseif ($gradPoint >= 75) {
                    $gp = 3.75;
                } elseif ($gradPoint >= 70) {
                    $gp = 3.5;
                } elseif ($gradPoint >= 65) {
                    $gp = 3.25;
                } elseif ($gradPoint >= 60) {
                    $gp = 3.0;
                } elseif ($gradPoint >= 55) {
                    $gp = 2.75;
                } elseif ($gradPoint >= 50) {
                    $gp = 2.5;
                } elseif ($gradPoint >= 45) {
                    $gp = 2.25;
                } elseif ($gradPoint >= 40) {
                    $gp = 2.0;
                } else {
                    $gp = 0.0;
                }
    
                $gpsum = $gp * $item->credit;
                $totalGpSum += $gpsum;
                $totalCreditSum += $item->credit;
            } else {
                $marks = 0;
            }
        }
    
        if ($hasFail) {
            $gpa = 0;
        } else {
            if ($totalGpSum == 0 || $totalCreditSum == 0) {
                // Handle the case where GPA calculation is not possible
                $gpa = 0;
            } else {
                $gpa = $totalGpSum / $totalCreditSum;
            }
        }
 
    
            // if ($totalGpSum == 0 || $totalCreditSum == 0){

            // }
            // else{
            //  $gpa;

            // }
          
    
    
        return view('backend.degreefirstyear_testimonial', compact('basic','resultdata','className','ndata','gpa' ));
    }

}
