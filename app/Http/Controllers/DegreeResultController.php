<?php

namespace App\Http\Controllers;
use App\Models\DegreeStudentResult;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DegreeResultController extends Controller
{
   
    public function index()
    {

        $dep_result_info = DB::table('degree_student_results')
                                    ->orderBy('years', 'asc')
                                    ->get();
       $student_class = DB::table('degree_classes')
                                    ->orderBy('id', 'asc')
                                    ->get();
    
    
       $dep_result_info1 = DB::table('student_sessions')
                                    ->get();
                                    
               
  
        $Studentresult = DegreeStudentResult::orderBy('id','asc')->get();

     //gpa a ber kora jonno
    //    $stu_session = DB::table('student_sessions')
    //                         ->where('depart_id', $depart_id)
    //                         ->first();                                         
       $CourseInfo = DB::table('student_sessions')
                                        //  ->where('stu_id', $stu_session->stu_id)
                                        //  ->where('class_name','=', $stu_session->class_name)
                                         ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
                                         ->select('student_sessions.*', 'course_names.*')
                                         ->get();
  
        // @dd($CourseInfo);
        return view('backend.degree_result_list', compact('Studentresult','student_class','CourseInfo','dep_result_info1','dep_result_info'));
    }

 
    public function store(Request $request)
    {
        // return($request->all());
        DepartmentResult::updateOrCreate([
            'id' => $request->id ],
        [
            'year' => $request->year,          
            'depart_id' => $request->depart_id,
            'total_seat' => $request->total_seat,          
         
        ]);
        if($request->id!=0){
            return redirect('departmentresult')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('departmentresult')->with('massage', 'Inserted successfully!!!');
    }
          
    }


    
    public function edit($id)
    {
       $data = DepartmentResult::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        DepartmentResult::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}