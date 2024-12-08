<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\Student;
use App\Models\StudentHonoursFourthYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;
class StudentResultFourthYearController extends Controller
{
    public function index()
    {
      $depart_id    = Session::get('depart_id');
      $depart_name  = Session::get('depart_name');
      $studentinfo  = Student::where('depart_id', '=', $depart_id)->get();
  
  
      $classname    = StudenClass::all();
      $CourseName   = CourseName::where('depart_id', '=', $depart_id)->orderby('id','asc')->first();
      $Course   = CourseName::where('class_id', 4)->orderby('name','asc')->get();
     
      $studentclass = StudenClass::where('id', '=', 4)->first();
      $Student      = StudentHonoursFourthYear::where('depart_id', '=', $depart_id)->where('class_id',4)->latest()->get();
      $StudentResult = StudentResult::where('depart_id', '=', $depart_id)->where('class_id',4)->latest()->get();

      
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

      $depart_id = $request->depart_id;
      $depart_name = Session::get('depart_name');
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
        $newMark =round($roundedNewMark);//decimal chara value insert
          $dataInserts[] = [
              'student_id' => $student_id[$i],
              'depart_id' => $depart_id,
              'department' => 0,
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
    
            StudentResult::updateOrCreate(
              [
                  'student_id' => $dataInsert['student_id'],
                  'subject' => $dataInsert['subject'],
                  'years' => $dataInsert['years'],
                  'class_id' => $dataInsert['class_id']
              ],
              $dataInsert
          );
      
      }
    
      Session::put('depart_id', $depart_id);
      Session::put('depart_name', $depart_name);
       
       return redirect('students-result-fourth-year')->with('message', 'Inserted successfully!!!');
    
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
        $class_year = $request->student_class_year;
        $year = $request->year;
        $department = $request->department;
        $subject = $request->subject;
        $sub_written_mark = $request->sub_written_mark;  
        for ($i=0; $i <count($marks) ; $i++) 
        {
          $roundedNewMark = $marks[$i] * 100 / $sub_written_mark;
          $newMark =round($roundedNewMark);//decimal chara value insert
             $dataInsert =[
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
          //      'department' => $department,
                'subject' => $subject,
                'written_mark' => $marks[$i],
                'marks' => $newMark,
                'name' => $name[$i],
                'years' => $year,
                'class_id' => $class_id,
                'student_class_year' => $class_year, 
                
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

    public function StudentFourthYear($id){  
      $student_year = DB::table('student_honours_fourth_years')->where('class_id', $id)->orderBy('session_year','desc')->get(); 
      return response()->json($student_year);
 }
    public function getUserbyidFourth(Request $request){
      // return($request->all());
      $depart_id    = Session::get('depart_id');
      $userid         = $request->userid;
      $data = explode('/', $userid);  
      $class_id = $data[0]; 
      $class_year = $data[1]; 
      $Students = DB::table('student_honours_fourth_years')
                ->where('depart_id', $depart_id)
                ->where('class_id', $class_id)
                ->where('session_year', $class_year)
                ->where('class_typeof', 1)
                ->orderBy('registration_no','asc')
                ->get();
      $trList           = [];
      foreach ($Students as $value) {
        $trList[] = '<tr>
        <td align="center">'. $value->id .'</td>
        <td align="center">
         <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->student_name .'" required="">
         </td> 
         <input type="hidden" name="sid[]" value="'. $value->id .'" >
         <td align="center">
         <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Marks " value="" required="">
         </td>
        </tr>';         
      }
    
      return $trList;
   }
   public function fourthYearMarksheet($registration_no)
   {
     $studentInfos = Student::where('registration_no', $registration_no)->first();
     $studentInfo = StudentHonoursFourthYear::where('registration_no',$registration_no)->first();
        $stuinfo = DB::table('student_honours_fourth_years')  
        ->where('id', $studentInfo->id)
        ->where('class_id', $studentInfo->class_id)
        ->where('depart_id', $studentInfo->depart_id)
        ->first();
      $examyear= DB::table('student_results')  
          ->where('student_id', $stuinfo->id)
          ->where('class_id', $stuinfo->class_id)
          ->where('student_class_year', $stuinfo->session_year)
          ->where('depart_id', $stuinfo->depart_id)
          ->first();
     $Course = DB::table('student_honours_fourth_years')
               ->where('student_honours_fourth_years.id', $studentInfo->id)
               ->where('student_honours_fourth_years.class_id', $studentInfo->class_id)
               ->where('course_names.depart_id', $studentInfo->depart_id)
               ->join('course_names', 'student_honours_fourth_years.class_id', '=', 'course_names.class_id')
               ->select('student_honours_fourth_years.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
               ->get();
 
      return view('backend.mark_sheet_4thyear_download', compact('Course','studentInfos','examyear'));
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


    public function mark_sheet_download($student_id)
    {
    return($student_id);
    //  $studentInfos = basic::where('id', $student_id)->first();
      //student data neyar jonno
    //  $DepartName = Session::get('depart_name');
    //  $studentInfo = Student::where('id', $student_id)->first();
    //  $studentInfos = Student::where('id', $student_id)->first(); 

    //  $CourseInfo = DB::table('students')
    //  ->where('students.id', $studentInfo->id) // Specify the 'students' table
    //  ->where('students.studentclass', $studentInfo->studentclass)
    //  ->join('course_names', 'students.studentclass', '=', 'course_names.class_id')
    //  ->select('students.*', 'course_names.*')
    //  ->get();
    // $Courselist = DB::table('students')
    // ->where('students.id', $studentInfo->id) // Specify the 'students' table
    // ->where('students.studentclass', $studentInfo->studentclass)
    // ->join('course_names', 'students.studentclass', '=', 'course_names.class_id')
    // ->select('students.*', 'course_names.*')
    // ->get();
                                  
    // $ExamYear = DB::table('student_results')
    //                                   ->where('student_id', $Courselist->stu_id)
    //                                   ->where('subject', $Courselist->id)
    //                                   ->first();
            
    // $ExamClassName = DB::table('studen_classes')
    //                                   // ->where('depart_id', $ExamYear->depart_id)
    //                                   ->where('id', $ExamYear->class_id)
    //                                   ->first();
    //   return view('backend.mark_sheet_download', compact('studentInfos','CourseInfo','DepartName','ExamYear','ExamClassName'));
    }




}
