<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\academic;
use App\Models\StudentResult;
use App\Models\DepartmentResult;
use App\Models\Department;
use App\Models\Student;
use App\Models\StudentSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DepartmentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $department  = Session::get('depart_name');
     
        $dep_result_info = DB::table('student_results')
                                    ->where('depart_id', $depart_id)
                                    ->orderBy('years', 'asc')
                                    ->get();
       $student_class = DB::table('studen_classes')
                                    ->orderBy('id', 'asc')
                                    ->get();
    
    
       $dep_result_info1 = DB::table('student_sessions')
                                    ->where('depart_id', $depart_id)
                                    ->get();
                                    
        $academic      = academic::orderBy('id', 'asc')->get();
       
  
        $Studentresult = StudentResult::orderBy('id','asc')->get();

     //gpa a ber kora jonno
       $stu_session = DB::table('student_sessions')
                            ->where('depart_id', $depart_id)
                            ->first();                                         
       $CourseInfo = DB::table('student_sessions')
                                         ->where('stu_id', $stu_session->stu_id)
                                         ->where('class_name','=', $stu_session->class_name)
                                         ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
                                         ->select('student_sessions.*', 'course_names.*')
                                         ->get();
  
        // @dd($CourseInfo);
        return view('backend.departmentresult', compact('Studentresult','student_class','CourseInfo','academic','department','dep_result_info1','dep_result_info'));
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