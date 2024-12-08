<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\Student;
use App\Models\StudentHonoursSecoundYear;
use App\Models\StudentHonoursThirdYear;
use App\Models\StudentHonoursFourthYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;

class StudentConsolidatedResultFinalYearController extends Controller
{
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');
        $studentinfo  = Student::where('depart_id', '=', $depart_id)->get();
    
    
        $classname = StudenClass::where('depart_id', $depart_id)->skip(3)->take(1)->first();
        $CourseName = CourseName::where('depart_id', $depart_id)->orderby('id','asc')->where('class_id', $classname->id)->first();
        $Course = CourseName::where('class_id', $CourseName->class_id)->orderby('id','asc')->get();
           
        $studentclass = StudenClass::where('depart_id', '=', $depart_id)->get()[3];
        $Student      = StudentSession::where('depart_id', '=', $depart_id)->where('class_name',$studentclass->id)->get();
        
        $Studentlist      = Student::where('depart_id', '=', $depart_id)->get();
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentresultfourthyear', compact('depart_id','Course','Studentlist','depart_name','studentinfo','Student','CourseName','classname','studentclass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){ 

// return($request->all());
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');
        $name = $request->name;
        $student_id = $request->sid;
        $depart_id = $request->depart_id;
        $marks = $request->marks;
        $classId = $request->classId;
        $year = $request->year;
        $department = $request->department;
        $subject = $request->subject;   

      
        for ($i=0; $i<count($marks) ; $i++) 
        {
             $dataInsert =[
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
                'department' =>0,
                'subject' => $subject,
                'marks' => $marks[$i],
                'name' => $name[$i],
                'years' => $year,
                'class_id' => $classId, 
            ];

           StudentResult::create($dataInsert);
        }
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
       
       return redirect('students-result-second-year')->with('massage', 'Inserted successfully!!!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function postvalue(Request $request){
    return($request->all());
       $depart_id = $request->depart_id;
       $depart_name = Session::get('depart_name');
        $name = $request->name;
        $student_id = $request->sid;
        $depart_id = $request->depart_id;
        $marks = $request->marks;
        return   $marks;
        $class_id = $request->classId;
        $year = $request->year;
        $department = $request->department;
        $subject = $request->subject;

        for ($i=0; $i <count($marks) ; $i++) 
        {
             $dataInsert =[
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
          //      'department' => $department,
                'subject' => $subject,
                 'marks' => $marks[$i],
                'name' => $name[$i],
                'years' => $year,
                'class_id' => $class_id,
                
                
            ];
        //   StudentResult::create($dataInsert);

        } Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
         //return back;
       }

       

 public function searchsubjet($id)
    {   
    
          $studentclass = StudenClass::find($id);
        // $studentclass =DB::table('course_names')->where('class_id', '=', $id)->get();
 return $studentclass;

      //  return response()->json($studentclass);
    }



    public function edit($id)
    {
        $data = Student::find($id);
        return response()->json($data);
    }

    public function getUserbyid(Request $request){
      $class_id         = $request->userid;  
      $Students = DB::table('student_sessions')
            ->where('class_name', $class_id)
            ->join('students', 'student_sessions.stu_id', '=', 'students.id')
            ->select('student_sessions.*', 'students.name')
            ->get();
      $trList           = [];
      foreach ($Students as $value) {
        $trList[] = '<tr><td align="center">'. $value->stu_id .'</td><td align="center"> <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->name .'" required=""></td> 
         <input type="hidden" name="sid[]" value="'. $value->stu_id .'" ><td align="center"><input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Marks " value="" required=""></td>
        </tr>';         
      }
    
      return $trList;
   }
  
  //   public function getUserId(Request $request){
    
  //   $subjce_id         = $request->id;  
  //     $Subject   = CourseName::where('class_id', '=', $subjce_id)->get();
  //     return $Subject;
  //  }
  


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
         $studentResult = StudentResult::where('depart_id', '=', $depart_id)->groupBy('years')->get();
     return view('backend.result', compact('data','studentResult'));
      }

    public function findresult($id,$years)
    {
      $studentResult = StudentResult::where('student_id', '=', $id)->where('years', '=', $years)->get();
      return $marks=sum($studentResult->marks);
      //return response()->json($studentclass);
    }

    public function consolidated_result($registration_no)
    {
    
      $studentInfos = Student::where('registration_no', $registration_no)->first();
      $student1stInfo = Student::where('registration_no', $registration_no)->first();
      $student2ndInfo = StudentHonoursSecoundYear::where('registration_no',$registration_no)->first();
      $student3rdInfo = StudentHonoursThirdYear::where('registration_no',$registration_no)->first();                     
      $student4thInfo = StudentHonoursFourthYear::where('registration_no',$registration_no)->first();
      
          $stuinfo = DB::table('student_honours_fourth_years')  
          ->where('id', $student4thInfo->id)
          ->where('class_id', $student4thInfo->class_id)
          ->where('depart_id', $student4thInfo->depart_id)
          ->first();
        $examyear= DB::table('student_results')  
            ->where('student_id', $stuinfo->id)
            ->where('class_id', $stuinfo->class_id)
            ->where('student_class_year', $stuinfo->session_year)
            ->where('depart_id', $stuinfo->depart_id)
            ->first();
     $depart_id    = Session::get('depart_id');
     
     $TotalCredit = CourseName::where('depart_id', $depart_id)->get(); 
     //first year
     $CourseInfo1stYear = DB::table('students')
                                      ->where('students.id', $student1stInfo->id)
                                      ->where('students.studentclass', $student1stInfo->studentclass)
                                      ->where('course_names.depart_id', $student1stInfo->depart_id)
                                      ->join('course_names', 'students.studentclass', '=', 'course_names.class_id')
                                      ->select('students.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
                                      ->get();            
     //second year                                 
     $CourseInfo2ndYear = DB::table('student_honours_secound_years')
                                      ->where('student_honours_secound_years.id', $student2ndInfo->id)
                                      ->where('student_honours_secound_years.class_id', $student2ndInfo->class_id)
                                      ->where('course_names.depart_id', $student2ndInfo->depart_id)
                                      ->join('course_names', 'student_honours_secound_years.class_id', '=', 'course_names.class_id')
                                      ->select('student_honours_secound_years.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
                                      ->get();
     //third year        
     $CourseInfo3rdYear = DB::table('student_honours_third_years')
                                  ->where('student_honours_third_years.id', $student3rdInfo->id)
                                  ->where('student_honours_third_years.class_id', $student3rdInfo->class_id)
                                  ->where('course_names.depart_id', $student3rdInfo->depart_id)
                                  ->join('course_names', 'student_honours_third_years.class_id', '=', 'course_names.class_id')
                                  ->select('student_honours_third_years.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
                                  ->get();   
      //fourth year result    
                         
     $CourseInfo4thYear = DB::table('student_honours_fourth_years')
                                  ->where('student_honours_fourth_years.id', $student4thInfo->id)
                                  ->where('student_honours_fourth_years.class_id', $student4thInfo->class_id)
                                  ->where('course_names.depart_id', $student4thInfo->depart_id)
                                  ->join('course_names', 'student_honours_fourth_years.class_id', '=', 'course_names.class_id')
                                  ->select('student_honours_fourth_years.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
                                  ->get(); 

      return view('backend.consolidated_result_final_year', compact('TotalCredit','studentInfos','CourseInfo1stYear','CourseInfo2ndYear','CourseInfo3rdYear','CourseInfo4thYear','examyear'));
    }
    
}
