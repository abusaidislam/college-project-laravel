<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\CourseFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;

class CourseFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = CourseFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        $courseName = CourseName::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentcourse_fee', compact('data','depart_value','classname','courseName'));
    }

  
    public function store(Request $request)
    {
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');
    
        // Check for existing record, excluding the current record if updating
        $existingRecord = CourseFee::where('depart_id', $request->depart_id)
            ->where('class_id', $request->class_id)
            ->where('session', $request->session)
            ->where('course_id', $request->course_id);
    
        if ($request->id != 0) {
            $existingRecord = $existingRecord->where('id', '<>', $request->id); 
        }
    
        if ($existingRecord->exists()) {
            return redirect('department-course-fee')->with('error', 'Duplicate data: Course Fee already exists!!!.');
        }
    
        $courseFee = CourseFee::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'depart_id' => $request->depart_id,
                'dname' => $depart_name,
                'class_id' => $request->class_id,
                'session' => $request->session,
                'course_id' => $request->course_id,
                'fee_amount' => $request->fee_amount
            ]
        );

    
        if ($request->id != 0) {
            return redirect('department-course-fee')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('department-course-fee')->with('message', 'Inserted successfully!!!');
        }
    }
    

    public function edit($id)
    {
         $data = CourseFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        CourseFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }

    public function StudentFeeSession($id)
    {  
        $departId = Session::get('depart_id');
        $data = [];
    
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('students')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 1)->orderBy('course_code', 'asc')->get(); 
                break;
            case 2:
                $data['sessions'] = DB::table('student_honours_secound_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 2)->orderBy('course_code', 'asc')->get(); 
                break;
            case 3:
                $data['sessions'] = DB::table('student_honours_third_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 3)->orderBy('course_code', 'asc')->get(); 
                break;
            case 4:
                $data['sessions'] = DB::table('student_honours_fourth_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get(); 
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 4)->orderBy('course_code', 'asc')->get(); 
                break;
            case 5:
                $data['sessions'] = DB::table('student_preliminary_to_masters')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 5)->orderBy('course_code', 'asc')->get(); 
                break;
            default:
                $data['sessions'] = DB::table('student_masters_finals')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 6)->orderBy('course_code', 'asc')->get(); 
                break;
        }
    
        return response()->json($data);
    }
    
    public function getCourseFeeSession(Request $request) {
        $id = $request->class_id;
        $courseId = $request->course_id;
        $session = $request->session;
        $departId = Session::get('depart_id');
        $data = [];
    
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('students')->select('session')->distinct()->where('depart_id', $departId)->where('session', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 1)->where('id', $courseId)->first(); 
                break;
            case 2:
                $data['sessions'] = DB::table('student_honours_secound_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->where('session_year', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 2)->where('id', $courseId)->first(); 
                break;
            case 3:
                $data['sessions'] = DB::table('student_honours_third_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->where('session_year', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 3)->where('id', $courseId)->first(); 
                break;
            case 4:
                $data['sessions'] = DB::table('student_honours_fourth_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->where('session_year', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 4)->where('id', $courseId)->first(); 
                break;
            case 5:
                $data['sessions'] = DB::table('student_preliminary_to_masters')->select('session')->distinct()->where('depart_id', $departId)->where('session', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 5)->where('id', $courseId)->first(); 
                break;
            default:
                $data['sessions'] = DB::table('student_masters_finals')->select('session')->distinct()->where('depart_id', $departId)->where('session', $session)->first();
                $data['courseName'] = DB::table('course_names')->select('course_code','id')->where('depart_id', $departId)->where('class_id', 6)->where('id', $courseId)->first(); 
            }
    
        return response()->json($data);
    }
   
}
