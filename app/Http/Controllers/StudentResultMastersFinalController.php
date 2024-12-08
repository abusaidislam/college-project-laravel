<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\Student;
use App\Models\StudentMastersFinal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;


class StudentResultMastersFinalController extends Controller
{
    public function index(){
    $depart_id    = Session::get('depart_id');
    $depart_name  = Session::get('depart_name');
    $studentinfo  = Student::where('depart_id', '=', $depart_id)->get();

    $classname    = StudenClass::all();
    $CourseName   = CourseName::where('depart_id', '=', $depart_id)->orderby('id','asc')->first();
    $Course   = CourseName::where('class_id', 6)->orderby('name','asc')->get();
   
    $studentclass = StudenClass::where('id', '=', 6)->first();
    $Student      = StudentMastersFinal::where('depart_id', '=', $depart_id)->where('studentclass',6)->latest()->get();
    $StudentResult = StudentResult::where('depart_id', '=', $depart_id)->where('class_id',6)->latest()->get();
    
    $Studentlist      = Student::where('depart_id', '=', $depart_id)->get();
    Session::put('depart_id', $depart_id);
    Session::put('depart_name', $depart_name);
    return view('backend.studentresult_mastersfinal', compact('depart_id','Course','StudentResult','Studentlist','depart_name','studentinfo','Student','CourseName','classname','studentclass'));
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
     
  return redirect('masters-final-result')->with('message', 'Inserted successfully!!!');
}


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
       return $studentclass;


}



public function edit($id)
{
    $data = Student::find($id);
    return response()->json($data);
}

   public function studentMastersFinal($id){  

    $student_year = DB::table('student_masters_finals')->where('studentclass', $id)->orderBy('session','desc')->get(); 
    return response()->json($student_year);
}

public function getUserbyidMastersFinal(Request $request){
  $depart_id    = Session::get('depart_id');
  $userid         = $request->userid;
  $data = explode('/', $userid);  
  $class_id = $data[0]; 
  $class_year = $data[1]; 
  $Students = DB::table('student_masters_finals')
        ->where('depart_id', $depart_id)
        ->where('studentclass', $class_id)
        ->where('session', $class_year)
        ->where('class_typeof', 2)
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
     $studentResult = StudentResult::where('depart_id', '=', $depart_id)->groupBy('years')->get();
 return view('backend.result', compact('data','studentResult'));
  }

public function findresult($id,$years)
{
  $studentResult = StudentResult::where('student_id', '=', $id)->where('years', '=', $years)->get();
  return $marks=sum($studentResult->marks);
  //return response()->json($studentclass);
}


public function masterFinalMarksheet($registration_no)
{

 $studentInfo = StudentMastersFinal::where('registration_no',$registration_no)->first();
 $studentInfos = StudentMastersFinal::where('registration_no', $registration_no)->first();
 $stuinfo = DB::table('student_masters_finals')  
 ->where('id', $studentInfo->id)
 ->where('studentclass', $studentInfo->studentclass)
 ->where('depart_id', $studentInfo->depart_id)
 ->first();
 $examyear= DB::table('student_results')  
 ->where('student_id', $stuinfo->id)
 ->where('class_id', $stuinfo->studentclass)
 ->where('student_class_year', $stuinfo->session)
 ->where('depart_id', $stuinfo->depart_id)
 ->first();                                   
$CourseIn = DB::table('student_masters_finals')
                    ->where('student_masters_finals.id', $studentInfo->id)
                    ->where('student_masters_finals.studentclass', $studentInfo->studentclass)
                    ->where('course_names.depart_id', $studentInfo->depart_id)
                    ->join('course_names', 'student_masters_finals.studentclass', '=', 'course_names.class_id')
                    ->select('student_masters_finals.*', 'course_names.id AS course_id','course_names.name AS course_name','course_names.course_code','course_names.credit','course_names.marks' )
                    ->get();

  return view('backend.mark_sheet_masters_download', compact('CourseIn','studentInfos','examyear'));
}



}
