<?php

namespace App\Http\Controllers;

use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\FailCourseFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;

class FailStudentFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = FailCourseFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.student_fail_course_fee', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
       $depart_id = $request->depart_id;
       $depart_name = Session::get('depart_name');
       FailCourseFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $request->depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'title' => $request->title,
             'failcoursefee_amount' => $request->failcoursefee_amount,
        ]);
        
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('fail-course-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('fail-course-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('fail-course-fee')->with('error', 'The form was not filled up completely!!!');

        // }
    }

    public function edit($id)
    {
         $data = FailCourseFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        FailCourseFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
}
