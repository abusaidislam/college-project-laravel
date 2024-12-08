<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;
use App\Models\StudentIncourseMarks;
use PDF;
class StudentInCourseController extends Controller
{
    
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');

        $CourseName   = CourseName::where('depart_id', '=', $depart_id)->orderby('id','asc')->get();
        $studentclass = StudenClass::where('depart_id', '=', $depart_id)->get();
        $Student      = StudentSession::where('depart_id', '=', $depart_id)->get();
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.student_incourse', compact('depart_id','depart_name','Student','CourseName','studentclass'));
    }

    
   
    public function getUserId(Request $request){
        $userid         = $request->userid;
        $data = explode('/', $userid);  
        $class_id = $data[0]; 
        $class_year = $data[1]; 
        $Students = DB::table('student_sessions')
              ->where('class_name', $class_id)
              ->where('class_year', $class_year)
              ->join('students', 'student_sessions.stu_id', '=', 'students.id')
              ->select('student_sessions.*', 'students.name')
              ->get();
        $trList           = [];
        foreach ($Students as $value) {
          $trList[] = '<tr>
          <td align="center">'. $value->stu_id .'</td>
          <td align="center">
           <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->name .'" required="">
           </td> 
           <input type="hidden" name="sid[]" value="'. $value->stu_id .'" >
           <td align="center">
           <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Marks " value="" required="">
           </td>
           <td align="center">
           <input type="text" class="form-control" id="day" name="day[]" placeholder="Enter Atten.Day " value="" required="">
           </td>
          </tr>';         
        }
      
        return $trList;
     }
    
     public function exportToPDF(Request $request)
     {
         $class = $request->classId;
         $years = $request->year;
         $depart_id = Session::get('depart_id');
         
         $data = StudentIncourseMarks::where('depart_id', $depart_id)
             ->where('class_id', $class)
             ->where('years', $years)
             ->get();
         
         if ($data->isEmpty()) {
             return view('backend.show_incourse_error');
         }
         
         $pdf = PDF::loadView('backend.pdf_view', ['data' => $data]);
         return $pdf->stream('document.pdf');
     }
     
}
