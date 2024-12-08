<?php

namespace App\Http\Controllers;

use App\Models\DegreeClass;
use App\Models\FailCourseFee;
use Illuminate\Http\Request;

class DegreeFailCoursFeeController extends Controller
{
    public function index()
    {     // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = FailCourseFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->get();
        return view('backend.degree_fail_course_fee', compact('data','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
            $depart_id = 40;
            $depart_name = 'Department of Degree';
       FailCourseFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'title' => $request->title,
             'failcoursefee_amount' => $request->failcoursefee_amount,
        ]);
        if($request->id!=0){
            return redirect('degree-fail-course-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-fail-course-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('degree-fail-course-fee')->with('error', 'The form was not filled up completely!!!');

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
