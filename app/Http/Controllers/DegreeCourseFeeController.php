<?php

namespace App\Http\Controllers;

use App\Models\DegreeClass;
use App\Models\CourseName;
use App\Models\CourseFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class DegreeCourseFeeController extends Controller
{
    public function index()
    {  
         // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = CourseFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        $courseName = CourseName::where('depart_id', '=', 40)->orderBy('class_id','asc')->get();
        return view('backend.degree_course_fee', compact('data','classname','courseName'));
    }

    public function store(Request $request)
    {
        $depart_id = 40;
        $depart_name ='Department of Degree';
    
        // Check for existing record, excluding the current record if updating
        $existingRecord = CourseFee::where('depart_id', $depart_id)
            ->where('class_id', $request->class_id)
            ->where('session', $request->session)
            ->where('course_id', $request->course_id);
    
        if ($request->id != 0) {
            $existingRecord = $existingRecord->where('id', '<>', $request->id); 
        }
    
        if ($existingRecord->exists()) {
            return redirect('degree-course-fee')->with('error', 'Duplicate data: Course Fee already exists!!!.');
        }
    
        $courseFee = CourseFee::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'depart_id' => $depart_id,
                'dname' => $depart_name,
                'class_id' => $request->class_id,
                'session' => $request->session,
                'course_id' => $request->course_id,
                'fee_amount' => $request->fee_amount
            ]
        );

    
        if ($request->id != 0) {
            return redirect('degree-course-fee')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-course-fee')->with('message', 'Inserted successfully!!!');
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

    public function degreeFeeSession($id)
    {  
        $data = [];
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('degree_first_year_students')->select('session')->distinct()->orderBy('session', 'desc')->get(); 
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 1)->orderBy('course_code', 'asc')->get(); 
                break;
            case 2:
                $data['sessions'] = DB::table('degree_secound_year_students')->select('session_year as session')->distinct()->orderBy('session_year', 'desc')->get();
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 2)->orderBy('course_code', 'asc')->get(); 
                break;
            default:
                $data['sessions'] = DB::table('degree_third_year_students')->select('session_year as session')->distinct()->orderBy('session_year', 'desc')->get();
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 3)->orderBy('course_code', 'asc')->get(); 
        }
    
        return response()->json($data);
    }
    
    public function degreeGetCourseFeeSession(Request $request) {
        $id = $request->class_id;
        $courseId = $request->course_id;
        $session = $request->session;
        $data = [];
    
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('degree_first_year_students')->select('session')->distinct()->where('session', $session)->first();
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 1)->where('id', $courseId)->first(); 
                break;
            case 2:
                $data['sessions'] = DB::table('degree_secound_year_students')->select('session_year as session')->distinct()->where('session_year', $session)->first();
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 2)->where('id', $courseId)->first(); 
                break;
            default:
                $data['sessions'] = DB::table('degree_third_year_students')->select('session_year as session')->distinct()->where('session_year', $session)->first();
                $data['courseName'] = DB::table('degree_courses')->select('course_code','id')->where('class_id', 3)->where('id', $courseId)->first(); 
            }
    
        return response()->json($data);
    }
   
}
