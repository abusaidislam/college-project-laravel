<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;
class StudentResultController extends Controller
{
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');
        $studentinfo  = Student::where('depart_id', '=', $depart_id)->get();
    
    
        $classname    = StudenClass::where('depart_id', '=', $depart_id)->get();
        $CourseName   = CourseName::where('depart_id', '=', $depart_id)->orderby('id','asc')->get();
           
        $studentclass = StudenClass::where('depart_id', '=', $depart_id)->get();
    
        $Student      = StudentSession::where('depart_id', '=', $depart_id)->get();
        $Studentlist      = Student::where('depart_id', '=', $depart_id)->get();
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentresultmanage', compact('depart_id','Studentlist','depart_name','studentinfo','Student','CourseName','classname','studentclass'));
    }

 
    public function store(Request $request){ 

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
       
       return redirect('students-result')->with('massage', 'Inserted successfully!!!');
    
    }


   public function StudentYearSession($id){  
  
        $student_year = DB::table('student_sessions')->where('class_name', $id)->orderBy('session_year','desc')->get(); 
         return response()->json($student_year);
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
      $depart_id    = Session::get('depart_id');
      $userid         = $request->userid;
      $data = explode('/', $userid);  
      $class_id = $data[0]; 
      $class_year = $data[1]; 
      $Students = DB::table('students')
            ->where('depart_id', $depart_id)
            ->where('studentclass', $class_id)
            ->where('session', $class_year)
            ->where('class_typeof', 1)
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

}
