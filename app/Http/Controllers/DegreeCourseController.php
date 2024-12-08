<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DegreeCourse;
use App\Models\DegreeClass;
use Illuminate\Validation\Rule;

class DegreeCourseController extends Controller
{
    public function index()
    {  
        $class = DegreeClass::orderBy('name', 'asc')->get();
        $data = DegreeCourse::orderBy('name','asc')->get();
        return view('backend.degreecourse', compact('data','class'));
    }

   public function store(Request $request)
    {
        try {
            DegreeCourse::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'course_code' => $request->course_code, 
                    'class_id' => $request->sclass,
                    'credit' => $request->credit,
                    'marks' => $request->marks,
                ]
            );
            
            if ($request->id != 0) {
                return redirect('degree-course')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree-course')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree-course')->with('error', 'The form was not filled up completely!!!');

        }

}    

   
    public function edit($id)
    {
         $data = DegreeCourse::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DegreeCourse::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
}
