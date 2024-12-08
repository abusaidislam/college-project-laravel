<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use App\Models\CourseName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;
class CourseNameController extends Controller
{  
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = CourseName::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.studentcourse', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
        try {
       $depart_id = $request->depart_id;
       $depart_name = Session::get('depart_name');
       $class_typeof = StudenClass::select('type_of')->where('id', $request->sclass)->first();
       CourseName::updateOrCreate([
            'id' => $request->id ],
        [
            
             'name' => $request->name,
             'depart_id' => $request->depart_id,
             'course_code' => $request->code,
             'department' => $depart_name,
             'class_id' => $request->sclass,
             'class_typeof' => $class_typeof->type_of,
             'credit' => $request->credit,
             'marks' => $request->marks,
           
            
        ]);

       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('department-course')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('department-course')->with('message', 'Inserted successfully!!!');
        }
        } catch (\Exception $e) {
            return redirect('department-course')->with('error', 'The form was not filled up completely!!!');

        }
    }

    public function edit($id)
    {
         $data = CourseName::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        CourseName::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
}
