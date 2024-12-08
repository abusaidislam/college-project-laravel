<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\DegreeStudentResult;
use App\Models\DegreeThirdYearStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\DegreeCourse;

class DegreeResultThirdYearStudentController extends Controller
{
    public function index()
    {
    
    
        $classname    = DegreeClass::all();
        $CourseName   = DegreeCourse::orderBy('id','asc')->first();
        $Course   = DegreeCourse::where('class_id', 3)->orderBy('name','asc')->get();

           
        $studentclass = DegreeClass::where('id', '=', 3)->first();
        $Student      = DegreeThirdYearStudent::where('class_id',3)->latest()->get();
        $StudentSession  = DegreeThirdYearStudent::select('session_year')->where('class_id', 3)->orderBy('session_year','desc')->distinct()->get();
        $StudentResult = DegreeStudentResult::where('class_id',3)->latest()->get();
        
        $Studentlist      = DegreeThirdYearStudent::all();
        return view('backend.degreethirdyear_result', compact('Course','StudentSession','StudentResult','Studentlist','Student','CourseName','classname','studentclass'));
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
           
      return redirect('degree-third-year-result')->with('message', 'Inserted successfully!!!');
  }

  
   public function postvalue(Request $request){
    // return($request->all());
        $name = $request->name;
        $student_id = $request->sid;
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

       
       public function degreeThirdYear($id){  
  
        $student_year = DB::table('degree_third_year_students')->where('class_id', $id)->orderBy('session_year','desc')->get(); 
        return response()->json($student_year);
   }
       

 public function searchsubjet($id)
    {   
    
          $studentclass = StudenClass::find($id);
           return $studentclass;


    }



    public function edit($id)
    {
        $data = DegreeThirdYearStudent::find($id);
        return response()->json($data);
    }

    public function getUserbyDegreeThird(Request $request){
      $userid         = $request->userid;
      $data = explode('/', $userid);  
      $class_id = $data[0]; 
      $class_year = $data[1]; 
      $Students = DB::table('degree_third_year_students')
      ->where('class_id', $class_id)
      ->where('session_year', $class_year)
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


    public function degreeThirdYearMarksheet($registration_no)
    {

    $studentInfo = DegreeThirdYearStudent::where('registration_no',$registration_no)->first();
    $studentInfos = DegreeThirdYearStudent::where('registration_no', $registration_no)->first();
    $stuinfo = DB::table('degree_third_year_students')  
        ->where('id', $studentInfo->id)
        ->where('class_id', $studentInfo->class_id)
        ->first();
    $examyear= DB::table('degree_student_results')  
            ->where('student_id', $stuinfo->id)
            ->where('class_id', $stuinfo->class_id)
            ->where('student_class_year', $stuinfo->session_year)
            ->first();                              
    $CourseIn = DB::table('degree_third_year_students')
     ->where('degree_third_year_students.id', $studentInfo->id)
     ->where('degree_third_year_students.class_id', $studentInfo->class_id)
     ->join('degree_courses', 'degree_third_year_students.class_id', '=', 'degree_courses.class_id')
     ->select('degree_third_year_students.*', 'degree_courses.id AS course_id','degree_courses.name AS course_name','degree_courses.course_code','degree_courses.credit','degree_courses.marks')
     ->get();
 
      return view('backend.degree_thirdyear_marksheet', compact('CourseIn','studentInfos','examyear'));
    }


}
